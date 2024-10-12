<?php

namespace App\Console\Commands;

use App\Models\VaccineCenter;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheVaccineCenters extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'cache-vaccine-centers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Cache::forget('vaccine_centers');
        $vaccineCenters = VaccineCenter::all();
        Cache::put('vaccine_centers', $vaccineCenters, 3600 * 6); // Cache exisitng centers for 6 hours
    }
}
