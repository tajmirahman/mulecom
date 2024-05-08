<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Notifications\ActiveVendor;
use Illuminate\Support\Facades\Notification;

class AdminController extends Controller
{
    public function AdminDashboard(){
        return view('admin.index');
    }//end method
    public function AdminLogin(){
        return view('admin.admin_login');
    }//end method
    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification=array(
            'message'=>'Admin Logout Successfully',
            'alert-type'=>'success',
        );

        return redirect('/admin/login')->with($notification);
    }//end method
    public function AdminProfile(){
        $id=Auth::user()->id;
        $adminData= User::find($id);

        return view('admin.admin_profile',compact('adminData'));
    }//end method
    public function AdminProfileStore(Request $request){

        $id=Auth::user()->id;
        $data=User::find(($id));

        $data->name=$request->name;
        $data->email=$request->email;
        $data->phone=$request->phone;
        $data->address=$request->address;

        if ($request->file('photo')) {
            $file=$request->file('photo');
            @unlink(public_path('upload/admin_image/'.$data->photo));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image/'),$filename);
            $data['photo']=$filename;
        }
        $data->save();
        $notification=array(
            'message'=>'Admin Profile Updated Successfully',
            'alert-type'=>'success',
        );
        return redirect()->back()->with($notification);
    }//end method

    public function AdminPassword(){
        return view('admin.admin_password');
    }
    public function AdminPasswordChange(Request $request){

        $request-> validate([
            'old_password'=>'required',
            'new_password'=>'required |confirmed',
            // 'new_password_confirmation'=>'required',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {

            return back()->with('error','Your Password Does not Match!!');
        }
        $user=User::whereId($request->user()->id)->update([
            'password'=>Hash::make($request->new_password),
        ]);

        return back()->with('status','Your Password Successfully Change');


    }//end method

    public function InactiveVendor(){
        $inactivevendor=User::where('role','vendor')->where('status','inactive')->latest()->get();
        return view('backend.vendor.inactive_vendor',compact('inactivevendor'));

    }//end method


    public function ActiveVendor(){
        $activevendor=User::where('role','vendor')->where('status','active')->latest()->get();
        return view('backend.vendor.active_vendor',compact('activevendor'));

    }//end method


    public function InactiveVendorDetails($id){
        $inactiveVendorDetails=User::find($id);
        return view('backend.vendor.inactive_vendor_details',compact('inactiveVendorDetails'));
    }//end method


    public function ActiveVendorApprove(Request $request){
        $vendor_active=$request->id;

        User::find($vendor_active)->update([
            'status'=>'active'
        ]);



        $notification=array(
            'message'=>'Vendor Active Successfully',
            'alert-type'=>'success',
        );

        $actvuser= User::where('role','vendor')->get();
        Notification::send($actvuser, new ActiveVendor($request));

        return redirect()->route('active.vendor')->with($notification);
    }//end method

    public function ActiveVendorDetails($id){

        $activeVendorDetails=User::find($id);
        return view('backend.vendor.active_vendor_details',compact('activeVendorDetails'));
    }//end method

    public function InactiveVendorApprove(Request $request){
        $vendor_inactive=$request->id;

        User::find($vendor_inactive)->update([
            'status'=>'inactive'
        ]);



        $notification=array(
            'message'=>'Vendor Inactive Successfully',
            'alert-type'=>'success',
        );
        return redirect()->route('inactive.vendor')->with($notification);
    }//end method





}

