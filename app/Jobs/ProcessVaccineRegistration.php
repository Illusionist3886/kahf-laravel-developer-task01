<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Carbon\Carbon;

class ProcessVaccineRegistration implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $user;
    /**
     * Create a new job instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        DB::transaction(function() {
            $user = $this->user;
            $vaccineCenter = VaccineCenter::select('id', 'available_quantity')->find($user->vaccine_center_id);
    
            if($vaccineCenter && $vaccineCenter->available_quantity > 0) {

                $currentDateTime = now();

                if ($currentDateTime->format('H') >= 18) {
                    // Add one day if it's after 6:00 PM
                    $currentDateTime->addDay();
                }

                if ($currentDateTime->isFriday() || $currentDateTime->isSaturday()) {
                    $currentDateTime = Carbon::parse('next sunday');
                }

                $user->scheduled_at = now();
                $user->scheduled_date = $currentDateTime->format('Y-m-d');
                $user->vaccine_status = 'Scheduled';
                $user->save(); 
    
                $user->vaccineSchedule()->create([
                    'vaccine_center_id' => $user->vaccine_center_id,
                    'schedule_date'     => $currentDateTime->format('Y-m-d')
                ]);
    
                $vaccineCenter->update([
                    'available_quantity' => --$vaccineCenter->available_quantity
                ]);
            }

            $lock = Cache::lock('user_vaccine_status', 60); 

            $userWithSchedule = collect([
                'id' => $user->id,
                'nid' => $user->nid,
                'vaccine_status' => $user->vaccine_status,
                'vaccine_schedule' => ($vaccineCenter && $vaccineCenter->available_quantity > 0) ? ['schedule_date' => $user->vaccineSchedule->schedule_date] : null
            ]);

            if ($lock->get()) {
                try {
                    $cachedUsers = Cache::get('user_vaccine_status', []);

                    $cachedUsers = ($cachedUsers instanceof \Illuminate\Support\Collection) ? $cachedUsers : collect([]);
                    $cachedUsers->push($userWithSchedule);

                    Cache::put('user_vaccine_status', $cachedUsers, 3600 * 18); // Update cache for 18 hours
                } finally {
                    $lock->release();
                }
            } else {
                $cachedUsers = Cache::get('user_vaccine_status', []);

                $cachedUsers = ($cachedUsers instanceof \Illuminate\Support\Collection) ? $cachedUsers : collect([]);
                $cachedUsers->push($userWithSchedule);

                Cache::put('user_vaccine_status', $cachedUsers, 3600 * 18); // Update cache for 18 hours
            }
            

        });
        
    }
}
