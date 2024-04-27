<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function AllCoupon(){
        $coupon= Coupon::latest()->get();
        return view('backend.coupon.coupon_all',compact('coupon'));
    }//end method


    public function AddCoupon(){
        $coupon= Coupon::latest()->get();
        return view('backend.coupon.coupon_add',compact('coupon'));
    }//end method

    public function StoreCoupon(Request $request)
    {

        Coupon::insert([
            'coupon_name' => strtoupper($request->coupon_name),
            'discount' => $request->discount,
            'validity' => $request->validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);
    } // End Method

    public function EditCoupon($id)
    {

        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.edit_coupon', compact('coupon'));

    } // End Method

    public function UpdateCoupon(Request $request)
    {

        $coupon_id = $request->id;

        Coupon::findOrFail($coupon_id)->update([
            'coupon_name' => strtoupper($request->coupon_name),
            'discount' => $request->discount,
            'validity' => $request->validity,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Coupon Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.coupon')->with($notification);

    }// end method

    public function DeleteCoupon($id)
    {

        Coupon::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // End Method 



}
