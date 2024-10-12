<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\VaccineCenter;
use Illuminate\Bus\Queueable;
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
        $user = $this->user;
        $checkAvailability = VaccineCenter::select('id', 'available_quantity')->find($user->vaccine_center_id);

        if($checkAvailability && $checkAvailability->available_quantity > 0) {
            $user->scheduled_date = now();
            $user->vaccine_status = 'Scheduled';
            $user->save(); 

            $user->vaccineSchedule()->create([
                'vaccine_center_id' => $user->vaccine_center_id,
                'schedule_date'     => now()->format('Y-m-d')
            ]);

            $checkAvailability->update([
                'available_quantity' => --$checkAvailability->available_quantity
            ]);
        }
    }
}
