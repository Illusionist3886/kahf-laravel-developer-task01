<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

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
        foreach($this->vaccineCenters as $vaccineCenter) {
            $limit = $vaccineCenter->capacity;

            $users = User::where([
                'vaccine_center_id' => $vaccineCenter->id,
                'vaccine_status' => 'Not Scheduled'
            ])->take($limit)->get();

            DB::transaction(function() use($users, $vaccineCenter) {
                $users->each(function ($user) use($vaccineCenter) {
                    $user->scheduled_date = now();
                    $user->vaccine_status = 'Scheduled';
                    $user->save(); 
                    
                    $user->vaccineSchedule()->create([
                        'vaccine_center_id' => $vaccineCenter->id,
                        'schedule_date'     => now()->format('Y-m-d')
                    ]);
                });
    
                $vaccineCenter->update([
                    'available_quantity' => $vaccineCenter->capacity - count($users)
                ]);
            });

        }
    }
}
