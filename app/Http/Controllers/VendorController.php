<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use App\Notifications\VendorLoginNotification;
use Illuminate\Support\Facades\Notification;

class VendorController extends Controller
{
    public function VendorDashboard(){
        return view('vendor.index');
    }
    public function VendorLogin(){
        return view('vendor.vendor_login');
    }


    public function VendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification=array(
            'message'=>'User Logout Successfully',
            'alert-type'=>'success',
        );

        return redirect('/vendor/login')->with($notification);
    }
    public function VendorProfile(){
        $id=Auth::user()->id;
        $vendorData=User::find($id);

        return view('vendor.vendor_profile',compact('vendorData'));
    }
    public function VendorProfileStore(Request $request){

        $id=Auth::user()->id;
        $data=User::find(($id));

        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;
        $data->vendor_join=$request->vendor_join;
        $data->vendor_sort_info=$request->vendor_sort_info;

        if ($request->file('photo')) {
            $file=$request->file('photo');
            @unlink(public_path('upload/vendor_image/'.$data->photo));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/vendor_image/'),$filename);
            $data['photo']=$filename;
        }
        $data->save();

        return back()->with('status','Your Profile Update Successfully');
    }
    public function VendorPassword(){

        return view('vendor.vendor_password');
    }
    public function VendorPasswordChange(Request $request){

        $request->validate([
            'old_password'=>'required',
            'new_password'=>'required|confirmed',
        ]);

        if(!Hash::check($request->old_password, auth::user()->password)){
            return back()->with('error','Your Old Password Does not Match!!');
        }
            $user=User::whereId($request->user()->id)->update([
                'password'=>Hash::make($request->new_password)
            ]);
            return back()->with('status','Your  Password Successfully Change');


    }

    public function BecomeVendor(){
        return view('auth.become_vendor');

    }
    public function VendorRegister(Request $request){

        $vuser= User::where('role','admin')->get();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],

            'password' => ['required', 'confirmed', Rules\Password::min(8)->mixedCase()->symbols()->letters()->numbers()],
        ]);

        User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'vendor_sort_info' => $request->vendor_sort_info,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);

        $notification=array(
            'message'=>'Vendor Inserted Successfully',
            'alert-type'=>'success',
        );
        Notification::send($vuser, new VendorLoginNotification($request));

        return redirect()->route('vendor.login')->with($notification);




    }





}
