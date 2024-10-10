<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VaccineCenterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('vaccine_centers')->insert([
            [
                'city' => 'Dhaka',
                'area' => 'Dhanmondi',
                'name' => 'Dhanmondi Health Complex',
                'capacity' => 500,
                'available_quantity' => 500,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Uttara',
                'name' => 'Uttara General Hospital',
                'capacity' => 750,
                'available_quantity' => 750,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Gulshan',
                'name' => 'Gulshan Clinic',
                'capacity' => 300,
                'available_quantity' => 300,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Mirpur',
                'name' => 'Mirpur Health Center',
                'capacity' => 1000,
                'available_quantity' => 1000,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Banani',
                'name' => 'Banani Medical Center',
                'capacity' => 600,
                'available_quantity' => 600,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Mohammadpur',
                'name' => 'Mohammadpur Community Clinic',
                'capacity' => 450,
                'available_quantity' => 450,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Tejgaon',
                'name' => 'Tejgaon Health Institute',
                'capacity' => 550,
                'available_quantity' => 550,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Shahbag',
                'name' => 'Shahbag General Hospital',
                'capacity' => 400,
                'available_quantity' => 400,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Bashundhara',
                'name' => 'Bashundhara Health Complex',
                'capacity' => 700,
                'available_quantity' => 700,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Badda',
                'name' => 'Badda Community Clinic',
                'capacity' => 350,
                'available_quantity' => 350,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Paltan',
                'name' => 'Paltan Health Center',
                'capacity' => 900,
                'available_quantity' => 900,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Farmgate',
                'name' => 'Farmgate Medical Clinic',
                'capacity' => 600,
                'available_quantity' => 600,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Jatrabari',
                'name' => 'Jatrabari Medical Center',
                'capacity' => 750,
                'available_quantity' => 750,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Khilgaon',
                'name' => 'Khilgaon Health Care',
                'capacity' => 550,
                'available_quantity' => 550,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Rampura',
                'name' => 'Rampura Health Clinic',
                'capacity' => 400,
                'available_quantity' => 400,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Motijheel',
                'name' => 'Motijheel Health Complex',
                'capacity' => 850,
                'available_quantity' => 850,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Savar',
                'name' => 'Savar Medical Clinic',
                'capacity' => 1000,
                'available_quantity' => 1000,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Keraniganj',
                'name' => 'Keraniganj Health Center',
                'capacity' => 500,
                'available_quantity' => 500,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Kamrangirchar',
                'name' => 'Kamrangirchar Medical Complex',
                'capacity' => 600,
                'available_quantity' => 600,
            ],
            [
                'city' => 'Dhaka',
                'area' => 'Lalbagh',
                'name' => 'Lalbagh Community Hospital',
                'capacity' => 450,
                'available_quantity' => 450,
            ],
        ]);
    }
}
