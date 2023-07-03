<?php

namespace App\Http\Controllers;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class adminController extends Controller
{
    public function admindashboard(){
        return view('admin.index_admin');
    }

    public function Adminlogout(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function adminprofile(){

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.admin_profile_view',compact('profileData'));
    }

    public function adminProfileStore(Request $request){

        $id = Auth::user()->id;
        $data =User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->password = $request->password;
        $data->address = $request->address;
        $data->phone = $request->phone;

        if($request->file('photo')){
            $file = $request->file('photo');
            @unlink(public_path('upload/img/admin_image/'.$data->photo));
            $filename =date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/img/admin_image/'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }

    public function adminprofilepassword(){

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('admin.body.admin_password_change',compact('profileData'));
    }

    public function adminupdateprofile(Request $request){

        $request->validate([
            'old_password'=>'required',
            'new_password' => 'required|confirmed|min:8'
        ]);

        if(!Hash::check($request->old_password,Auth::user()->password)){
            $notification = array(
                'message' => 'Old Password Does Not Match',
                'alert-type' => 'error'
            );

            return back()->with($notification);
        }
        
        User::whereId(Auth::user()->id)->update([
            'password'=>Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password Updated Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification);

    }
}
