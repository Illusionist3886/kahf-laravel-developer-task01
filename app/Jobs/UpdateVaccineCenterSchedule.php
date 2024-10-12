<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class UpdateVaccineCenterSchedule implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vaccineCenters;
    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->vaccineCenters = VaccineCenter::get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        User::where('vaccine_status', 'Scheduled')->whereDate('scheduled_date', now()->format('Y-m-d'))->update(['vaccine_status' => 'Vaccinated']);

        $currentDateTime = now();

        if ($currentDateTime->format('H') >= 18) {
            // Add one day if it's after 6:00 PM
            $currentDateTime->addDay();
        }

        if ($currentDateTime->isFriday() || $currentDateTime->isSaturday()) {
            $currentDateTime = Carbon::parse('next sunday');
        }


        foreach($this->vaccineCenters as $vaccineCenter) {
            $limit = $vaccineCenter->capacity;

            $users = User::where([
                'vaccine_center_id' => $vaccineCenter->id,
                'vaccine_status' => 'Not Scheduled'
            ])->take($limit)->get();

            DB::transaction(function() use($users, $vaccineCenter, $currentDateTime) {

                // As all the applicant took the vaccine on time.

                $users->each(function ($user) use($vaccineCenter, $currentDateTime) {
                    $user->scheduled_date = $currentDateTime->format('Y-m-d');
                    $user->scheduled_at = now();
                    $user->vaccine_status = 'Scheduled';
                    $user->save(); 
                    
                    $user->vaccineSchedule()->create([
                        'vaccine_center_id' => $vaccineCenter->id,
                        'schedule_date'     => $currentDateTime->format('Y-m-d')
                    ]);
                   
                });
    
                $vaccineCenter->update([
                    'available_quantity' => $vaccineCenter->capacity - count($users)
                ]);
            });

        }
    }
}
