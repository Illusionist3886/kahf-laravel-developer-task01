<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\VaccineCenter;
use App\Models\VaccineSchedule;
use Illuminate\Support\Facades\Cache;
use App\Http\Requests\VaccineRegistrationRequest;
use App\Jobs\ProcessVaccineRegistration;

class VaccineRegistrationController extends Controller
{
    public function registration() {
        $vaccineCenters = Cache::get('vaccine_centers');

        if (!$vaccineCenters) {
            $vaccineCenters = VaccineCenter::all();
            Cache::put('vaccine_centers', $vaccineCenters, 3600 * 6); // Cache exisitng centers for 6 hours
        }

        return view('vaccination.registration', compact('vaccineCenters'));
    }

    public function completeRegistration(VaccineRegistrationRequest $request) {
        
        $userInfo = $request->only('name', 'nid', 'phone', 'email', 'vaccine_center_id', 'password');

        $user = User::create($userInfo);

        if ($user) {
            ProcessVaccineRegistration::dispatch($user);
        }

        return redirect()->route('registration.success')
                     ->with('success', 'Registration successful. We will notify when your vaccine is scheduled.');
    }

    public function success() {
        return view('vaccination.registration-success');
    }
}
