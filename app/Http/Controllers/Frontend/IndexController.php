<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
use App\Models\PropertyMessage;

use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use App\Models\Facility;
use App\Models\Amenities;
use App\Models\PropertyType;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\Models\PackagePlan;
use Illuminate\Auth\Events\Login;

class IndexController extends Controller
{
    public function PropertyDetails($id, $slug)
    {
        $property = Property::findOrFail($id);

        $facility = Facility::where('property_id', $id)->get();
        $property_id = $property->id;
        $multiImage = MultiImage::where('property_id', $id)->get();
        $amenities = $property->amenities_id;
        $property_amen = explode(',', $amenities);
        $type_id = $property->ptype_id;
        $relatedProperty = Property::where('ptype_id', $type_id)->where('id', '!=', $id)->orderBy('id', 'DESC')->limit(3)->get();
        $exists = Wishlist::where('user_id', Auth::id())->where('property_id', $property_id)->first();

        return view('frontend.property.property_details', compact('property', 'exists', 'multiImage', 'property_amen', 'facility', 'relatedProperty'));
    }
    //end

    public function PropertyMessage(Request $request)
    {
        $pid = $request->property_id;
        $aid = $request->agent_id;

        if (Auth::check()) {
            PropertyMessage::insert([

                'user_id' => Auth::user()->id,
                'agent_id' => $aid,
                'property_id' => $pid,
                'msg_name' => $request->msg_name,
                'msg_email' => $request->msg_email,
                'msg_phone' => $request->msg_phone,
                'message' => $request->message,
                'created_at' => Carbon::now(),
            ]);
            $notification = array(
                'message' => 'msg sent successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        } else {
            $notification = array(
                'message' => 'please login your account first',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
    }
    public function AgentDetails($id)
    {

        $agent = User::findOrFail($id);
        $property = Property::where('agent_id', $id)->latest()->get();
        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        return view('frontend.agent.agent_details', compact('agent', 'property', 'prent', 'psale'));
    } // End Method 

}
