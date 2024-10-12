<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\VaccineRegistrationRequest;
use App\Models\VaccineCenter;
use App\Models\VaccineSchedule;

class VaccineRegistrationController extends Controller
{
    public function registration() {
        $vaccineCenters = VaccineCenter::select('id', 'name')->get();

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

        $checkAvailability = VaccineCenter::select('id', 'available_quantity')->find($user->vaccine_center_id);

        if($checkAvailability && $checkAvailability->available_quantity > 0) {
            $user->scheduled_date = now();
            $user->vaccine_status = 'Scheduled';
            $user->save(); 

            $user->vaccineSchedule()->create([
                'vaccine_center_id' => $request->vaccine_center_id,
                'schedule_date'     => now()->format('Y-m-d')
            ]);

            $checkAvailability->update([
                'available_quantity' => --$checkAvailability->available_quantity
            ]);
        }

        return redirect()->route('registration.success') // Replace with your route
                     ->with('success', 'Registration successful. We will notify when your vaccine is scheduled.'); // Pass success message
    }

    public function success() {
        return view('vaccination.registration-success');
    }
}
