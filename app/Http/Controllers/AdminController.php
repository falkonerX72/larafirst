<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    } // End Method 
    public function AdminLogout(Request $request)
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification = array(
            'message' => 'successfully logged out',
            'alert-type' => 'success'
        );


        return redirect('/admin/login')->with($notification);
    } // End Method 


    public function AdminLogin()
    {
        $notification = array(
            'message' => 'successfully logged out',
            'alert-type' => 'success'
        );

        return view('admin.admin_login')->with($notification);
    } // End Method 
    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_profile_view', compact('profileData'));
    }
    public function AdminProfileStore(Request $request)
    {

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->username = $request->username;
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();
        $notification = array(
            'message' => 'Admin Profile Updated successfully!',
            'alert-type ' => 'success'
        );
        return redirect()->back()->with($notification);
    } // End Method 
    public function AdminChangePassword()
    {
        $id = Auth::user()->id;
        $profileData = User::find($id);
        return view('admin.admin_change_password', compact('profileData'));
    }
    public function AdminUpdatePassword(Request $request)
    {
        //validate
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed'
        ]);
        ///match passwords
        if (!Hash::check($request->old_password, auth::user()->password)) {
            $notification = array(
                'message' => 'old pass does not match!',
                'alert-type ' => 'error'
            );
            return back()->with($notification);
        }
        //update the new pass
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);
        $notification = array(
            'message' => 'password change!',
            'alert-type ' => 'success'
        );
        return back()->with($notification);
    }
}
