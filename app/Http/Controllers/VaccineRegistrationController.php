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
        
        $user = new User();

        $user->name = $request->name;
        $user->nid = $request->nid;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->vaccine_center_id = $request->vaccine_center_id;
        $user->password = bcrypt($request->password);

        $user->save();

        ProcessVaccineRegistration::dispatch($user);

        return redirect()->route('registration.success')
                     ->with('success', 'Registration successful. We will notify when your vaccine is scheduled.');
    }

    public function success() {
        return view('vaccination.registration-success');
    }
}
