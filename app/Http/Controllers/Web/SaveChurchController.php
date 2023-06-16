<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\SavedChurch;

use App\Http\Requests\SaveChurch\SaveChurchRequest;
use Carbon\Carbon;

class SaveChurchController extends Controller
{
    public function save_church(SaveChurchRequest $request) {
        $save_data = SavedChurch::where('owner_id', Auth::user()->id)->where('church_id', $request->church_id)->first();

        if($save_data) {
            $remove = $save_data->delete();
            if($remove) {
                return response()->json([
                    'status' => 'Removed',
                    'message' => 'Removed Sucessfully'
                ], 201);
            }
        }

        $save = SavedChurch::create([
            'owner_id' => Auth::user()->id,
            'church_id' => $request->church_id,
            'saved_date' => Carbon::now()
        ]);

        if($save) {
            return response([
                'status' => 'Saved',
                'message' => 'Saved Successfully'
            ], 201);
        }
    }

    public function user_list(Request $request) {
        return view('user-page.user-dashboard.save-churches');
    }
}
