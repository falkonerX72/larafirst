<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Property;
use App\Models\MultiImage;
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
    //
}
