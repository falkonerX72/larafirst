<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use App\Models\PropertyType;
use App\Models\State;
use App\Models\Amenities;
use Intervention\Image\Facades\Image;


class StateController extends Controller
{
    //start   public function
    public function AllState()
    {

        $state = State::latest()->get();
        return view('backend.state.all_state', compact('state'));
    } // End Method 
    public function AddState()
    {

        return view('backend.state.add_state');
    } // End Method 

    public function StoreState(Request $request)
    {

        $image = $request->file('state_image');
        $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
        Image::make($image)->resize(370, 275)->save('upload/state/' . $name_gen);
        $save_url = 'upload/state/' . $name_gen;

        State::insert([
            'state_name' => $request->state_name,
            'state_image' => $save_url,
        ]);

        $notification = array(
            'message' => 'State Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.state')->with($notification);
    } // End Method 

    public function EditState($id)
    {

        $state = State::findOrFail($id);
        return view('backend.state.edit_state', compact('state'));
    } // End Method 

    public function DeleteState($id)
    {
        State::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Property state Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method 

    public function UpdateState(Request $request)
    {
        $state_id = $request->id;

        if ($request->file('state_image')) {
            $image = $request->file('state_image');
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(370, 275)->save('upload/state/' . $name_gen);
            $save_url = 'upload/state/' . $name_gen;

            State::findOrFail($state_id)->update([
                'state_name' => $request->state_name,
                'state_image' => $save_url,
            ]);

            $notification = array(
                'message' => 'State updated  Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.state')->with($notification);
        } else {
            State::findOrFail($state_id)->update([
                'state_name' => $request->state_name,

            ]);
            $notification = array(
                'message' => 'State updated with no image Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.state')->with($notification);
        }
    } // End Method 

}
