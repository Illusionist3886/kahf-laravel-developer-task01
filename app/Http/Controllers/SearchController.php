<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SearchController extends Controller
{
    public function search() {
        return view('vaccination.search');
    }

    public function getStatusByNid(Request $request) {
        
        $nid = $request->nid;

        $cachedUsers = Cache::get('user_vaccine_status');
        $user = isset($cachedUsers) ? $cachedUsers->where('nid', $nid)->first() : null;
        
        if (!$user) {
            $user = User::select('id', 'nid', 'vaccine_status')
                    ->where('nid', $nid)
                    ->with([
                        'vaccineSchedule:schedule_date,user_id'
                    ])
                    ->first();

            if (!$user) {
                return response()->json([
                    'message' => 'User not found'
                ], 404);
            } 
        }
        
        return response()->json($user, 200);
    }

}
