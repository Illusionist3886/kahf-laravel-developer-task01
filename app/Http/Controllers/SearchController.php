<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search() {
        return view('vaccination.search');
    }

    public function getStatusByNid(Request $request) {
        $user = User::select('id', 'nid', 'scheduled_at', 'vaccine_status')
                ->where('nid', $request->nid)
                ->with([
                    'vaccineSchedule:id,schedule_date,user_id'
                ])
                ->first();
        
        if (!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 404);
        }
        
        return response()->json($user, 200);
    }
}
