<?php

namespace App\Console;

use App\Jobs\ProcessNotifyVaccineTaker;
use App\Jobs\UpdateVaccineCenterSchedule;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->command('cache-vaccine-centers')->everySixHours(); // Caching Vaccine Centers
        $schedule->job(new UpdateVaccineCenterSchedule)->weeklyOn(1,2,3,4,7, '18:05'); // Runs on Monday, Tuesday, Wednesday, Thursday and Sunday.
        $schedule->job(new ProcessNotifyVaccineTaker)->weeklyOn(1,2,3,6,7, '21:00'); // Runs on Monday, Tuesday, Wednesday, Staurday and Sunday.
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
