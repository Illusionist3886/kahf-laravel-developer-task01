<?php

namespace App\Jobs;

use App\Models\VaccineSchedule;
use App\Notifications\NotifyVaccineTaker;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessNotifyVaccineTaker implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $vaccineSchedules;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        $this->vaccineSchedules = VaccineSchedule::with('vaccineCenter')
                                  ->where([
                                    'email_sent' => 0,
                                    'schedule_date' => date('Y-m-d', strtotime('+1 day'))
                                    ])
                                  ->get();
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        foreach($this->vaccineSchedules as $schedule) {
            $user = $schedule->user;
            info($user);
            if($user) {
                try {
                    $user->notify(new NotifyVaccineTaker($schedule, $user->email));
                    $schedule->update(['email_sent' => 1]);
                } catch (\Throwable $th) {
                    // For Future Error Logging. Notify Dev Team via Slack/Discord or any custom api.
                }
            }
        }
    }
}
