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
use App\Models\State;
use App\Models\PropertyType;
use App\Models\User;
use Intervention\Image\Facades\Image;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Carbon\Carbon;
use App\Models\PackagePlan;
use Illuminate\Auth\Events\Login;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;

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
        $featured = Property::where('featured', '1')->latest()->get();
        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        return view('frontend.agent.agent_details', compact('agent', 'property', 'prent', 'psale', 'featured'));
    } // End Method 


    public function AgentDetailsMessage(Request $request)
    {
        $pid = $request->property_id;
        $aid = $request->agent_id;

        if (Auth::check()) {
            PropertyMessage::insert([

                'user_id' => Auth::user()->id,
                'agent_id' => $aid,

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
    public function RentProperty()
    {
        $property = Property::where('status', '1')->where('property_status', 'rent')->paginate(2);
        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        $ptype = PropertyType::latest()->limit(5)->get();
        $states = State::latest()->limit(5)->get();
        return view('frontend.property.rent_property', compact('property', 'prent', 'psale', 'states', 'ptype'));
    }
    public function BuyProperty()
    {
        $property = Property::where('status', '1')->where('property_status', 'buy')->paginate(2);
        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        return view('frontend.property.buy_property', compact('property', 'prent', 'psale'));
    }

    public function  PropertyType($id)
    {

        $property = Property::where('status', '1')->where('ptype_id', $id)->paginate(2);
        $pbread = PropertyType::where('id', $id)->first();
        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        return view('frontend.property.property_type ', compact('property', 'pbread', 'prent', 'psale'));
    }
    public function  AllPropertyFeatured()
    {

        $property = Property::where('status', '1')->where('featured', '1')->paginate(3);

        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        return view('frontend.property.all_property_featured ', compact('property', 'prent', 'psale'));
    }
    public function AllCategory()
    {
        $allcategory = PropertyType::latest()->get();

        return view('frontend.category.category', compact('allcategory'));
    }

    public function StateDetails($id)
    {
        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        $property  = Property::where('status', '1')->where('state', $id)->get();
        $bstate = State::where('id', $id)->first();
        return view('frontend.property.state_property', compact('property', 'prent', 'psale', 'bstate'));
    }
    public function BuyPropertySearch(request $request)
    {
        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $stype = $request->ptype_id;
        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        $property = Property::where('property_name', 'like', '%' . $item . '%')
            ->where('property_status', 'buy')->with('type', 'pstate')->whereHas('pstate', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })->paginate(1);
        ///like = search function,  % ha yani harchi ghablo baad bood ro begir, ye khone kamel
        return view('frontend.property.property_search', compact('property', 'prent', 'psale'));
    }

    public function RentPropertySearch(request $request)
    {
        $request->validate(['search' => 'required']);
        $item = $request->search;
        $sstate = $request->state;
        $stype = $request->ptype_id;
        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        $property = Property::where('property_name', 'like', '%' . $item . '%')
            ->where('property_status', 'rent')->with('type', 'pstate')->whereHas('pstate', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })->paginate(1);
        ///like = search function,  % ha yani harchi ghablo baad bood ro begir, ye khone kamel
        return view('frontend.property.property_search', compact('property', 'prent', 'psale'));
    }
    public function AllPropertySearch(Request $request)
    {
        $prent = Property::where('property_status', 'rent')->latest()->get();
        $psale = Property::where('property_status', 'buy')->latest()->get();
        $property_status = $request->property_status;
        $stype = $request->ptype_id;
        $sstate = $request->state;
        $bedrooms = $request->bedrooms;
        $bathrooms = $request->bathrooms;

        $property = Property::where('status', '1')
            ->where('bedrooms', $bedrooms)
            ->where('bathrooms', 'like', '%' . $bathrooms . '%')
            ->where('property_status', $property_status)
            ->with('type', 'pstate')
            ->whereHas('pstate', function ($q) use ($sstate) {
                $q->where('state_name', 'like', '%' . $sstate . '%');
            })
            ->whereHas('type', function ($q) use ($stype) {
                $q->where('type_name', 'like', '%' . $stype . '%');
            })
            ->paginate(2);

        return view('frontend.property.property_search', compact('property', 'prent', 'psale'));
    } // End Method 
}
