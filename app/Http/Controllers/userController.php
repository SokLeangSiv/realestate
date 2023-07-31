<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function index(){
        return view('frontend.index');
    }

    public  function UserProfile(){

        $id = Auth::user()->id;
        $user = User::find($id);


        return view('dashboard', compact('user'));
    }

    public function UserProfileedit(){
        $id = auth()->user()->id;
        $profileData= User::find($id);

        return view('frontend.dashboard.edit_profile',compact('profileData'));
    }

    public function UserProfileupdate(Request $request){

        $id = auth()->user()->id;
        $profileData= User::find($id);

        $profileData->name = $request->name;
        $profileData->email = $request->email;
        $profileData->phone = $request->phone;
        
        if($request->file('photo'))
        {
            $file= $request->file('photo');
            $filename = date('YmdHi').$file->getClientOriginalName();
            @unlink(public_path('upload/user_images/'.$profileData->photo));
            $file->move(public_path('upload/user_images'),$filename);
            $profileData->photo = $filename;
        }


        $profileData->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success'
        );



        return redirect()->route('frontend/frontend_dashboard')->with($notification);

    }

    public function Userlogout(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }


    public function UserPasswordChange(){

        $id = Auth::user()->id;
        $profileData = User::find($id);

        return view('frontend.dashboard.update_password',compact('profileData'));

    }


    public  function UserPasswordUpdate(Request $request){

         // Validation 
         $request->validate([
            'old_password' => 'required',
            'new_password' => 'required'

        ]);

        /// Match The Old Password

        if (!Hash::check($request->old_password, auth()->user()->password)) {

           $notification = array(
            'message' => 'Old Password Does not Match!',
            'alert-type' => 'error'
        );

        return back()->with($notification);
        }

        /// Update The New Password 

        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)

        ]);

         $notification = array(
            'message' => 'Password Change Successfully',
            'alert-type' => 'success'
        );

        return back()->with($notification); 


    }
}
