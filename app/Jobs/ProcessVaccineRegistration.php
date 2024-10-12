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
                $user->scheduled_at = now();
                $user->scheduled_date = now()->format('Y-m-d');
                $user->vaccine_status = 'Scheduled';
                $user->save(); 
    
                $user->vaccineSchedule()->create([
                    'vaccine_center_id' => $user->vaccine_center_id,
                    'schedule_date'     => now()->format('Y-m-d')
                ]);
    
                $vaccineCenter->update([
                    'available_quantity' => --$vaccineCenter->available_quantity
                ]);
            }

            if (Cache::has("user_status_{$user->nid}")) {
                Cache::forget("user_status_{$user->nid}");
            }
            
            Cache::put("user_status_{$user->nid}", $user, 3600 * 6 ); // Cache for 6 hours
        });
        
    }
}
