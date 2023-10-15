<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PropertyType;
use App\Models\State;
use App\Models\Amenities;
use Intervention\Image\Facades\Image;
use App\Models\Testimonial;




class TestimonialController extends Controller
{
    //  //start   public function
    public function AllTestimonial()
    {

        $testimonial = Testimonial::latest()->get();
        return view('backend.testimonial.all_testimonial', compact('testimonial'));
    } // End Method 
    public function AddTestimonial()
    {

        return view('backend.testimonial.add_testimonial');
    } // End Method 


    public function StoreTestimonial(Request $request)
    {

   
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(100, 100)->save('upload/testimonial/' . $name_gen);
        $save_url = 'upload/testimonial/' . $name_gen;

        Testimonial::insert([
            'name' => $request->name,
            'position' => $request->position,
            'message' => $request->message,
            'image' => $save_url,
        ]);

        $notification = array(
            'message' => 'testimonial Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.testimonial')->with($notification);
    } // End Method 
}
