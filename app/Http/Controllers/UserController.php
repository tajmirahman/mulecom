<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function Dashboard(){
        $id=Auth::user()->id;
        $userData= User::find($id);
        return view('index',compact('userData'));
    }//end method

    public function UserProfileStore(Request $request){
        $id=Auth::user()->id;
        $data= User::find($id);

        $data->username=$request->username;
        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;

        if ($request->file('photo')) {
            $file=$request->file('photo');
            @unlink(public_path('upload/user_image/'.$data['photo']));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_image/'),$filename);
            $data['photo']=$filename;
        }
        $data-> save();

        $notification=array(
            'message'=>'Your User Profile Update Successfully',
            'alert-type'=>'success'
        );


        return back()->with($notification);
    }//end method

    public function UserDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification=array(
            'message'=>'User Logout Successfully',
            'alert-type'=>'success',
        );

        return redirect('/login')->with($notification);
    }//end method

    public function UserPasswordChange(Request $request)
    {
       $request->validate([
        'old_password'=>'required',
        'new_password'=>'required|confirmed',
       ]);

       if (!Hash::check($request->old_password, Auth::user()->password)) {
            $notification=array(
                'message'=>'Old Password Does Not Match!!',
                'alert-type'=>'error',
            );
            return back()->with($notification);
       }
       $user=User::whereId($request->user()->id)->update([
        'password'=>Hash::make($request->new_password),
    ]);
       $notification=array(
        'message'=>'Your Password Successfully Changed',
        'alert-type'=>'success',
    );
    return back()->with($notification);


    }//end method
}
