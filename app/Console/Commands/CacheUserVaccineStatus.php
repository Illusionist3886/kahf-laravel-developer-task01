<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheUserVaccineStatus extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache-user-vaccine-status';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Cache User Vaccine Status.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $users = User::select('id', 'nid', 'vaccine_status')
                        ->with([
                            'vaccineSchedule:schedule_date,user_id'
                        ])
                        ->get();
        Cache::forget('user_vaccine_status');
        Cache::put('user_vaccine_status', $users, 3600 * 24); // Cache exisitng centers for 24 hours
    }
}
