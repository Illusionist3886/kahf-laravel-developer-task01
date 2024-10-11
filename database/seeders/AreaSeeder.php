<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AreaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('areas')->insert([
            [
                'city' => 'Dhaka',
                'area' => 'Dhanmondi'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Uttara'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Gulshan'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Mirpur'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Banani'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Mohammadpur'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Tejgaon'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Shahbag'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Bashundhara'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Badda'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Paltan',
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Farmgate'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Jatrabari'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Khilgaon'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Rampura'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Motijheel'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Savar'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Keraniganj'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Kamrangirchar'
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Lalbagh'
            ],
        ]);
    }
}
