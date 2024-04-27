<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function ReturnRequest(){
        $orders= Order::where('return_order',1)->orderBy('id','DESC')->get();
        return view('backend.return_order.return_request',compact('orders'));

    }// end method


    public function ReturnRequestSuccess($order_id){

        Order::where('id',$order_id)->update(['return_order'=> 2]);

        $notification = array(
            'message' => 'Order Return Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }// end method

    public function ReturnRequestComplete(){
        $orders= Order::where('return_order',2)->orderBy('id','DESC')->get();
        return view('backend.return_order.complete_return_request',compact('orders'));

    }// end method


}
