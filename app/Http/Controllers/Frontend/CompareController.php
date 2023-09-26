<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;


class CompareController extends Controller
{

    public function AddToCompare(Request $request, $property_id)
    {

        if (Auth::check()) {

            $exists = Compare::where('user_id', Auth::id())->where('property_id', $property_id)->first();

            if (!$exists) {
                Compare::insert([
                    'user_id' => Auth::id(),
                    'property_id' => $property_id,
                    'created_at' => Carbon::now()
                ]);
                return response()->json(['success' => 'Successfully Added On Your "<a href="#">compare</a>"']);
            } else {
                return response()->json(['error' => 'This Property Has Already in your compare']);
            }
        } else {
            return response()->json(['error' => 'At First "<a href="http://127.0.0.1:8000/login">login</a>" Your Account']);
        }
    } // End Method 
    public function UserCompare()
    {
        return view('frontend.dashboard.compare');
    }
    public function GetCompareProperty()
    {
        $id = Auth::user()->id;

        $compare = Compare::with('property')->where('user_id', $id)->latest()->get();

        return response()->json($compare);
    }
    public function CompareRemove($id)
    {
        Compare::where('user_id', Auth::id())->where('id', $id)->delete();

        return response()->json(['success' => 'successfully removed from Compare']);
    }
}
