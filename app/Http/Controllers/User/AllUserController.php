<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class AllUserController extends Controller
{
    public function UserAccount(){
        $id=Auth::user()->id;
        $userData= User::find($id);
        return view('frontend.userdashboard.account_details',compact('userData'));
    }//end method

    public function UserChangePassword(){

        return view('frontend.userdashboard.password_change');
    }//end method

    public function UserOrderPage(){

        $id= Auth::user()->id;
        $orders= Order::where('user_id',$id)->orderBy('id','DESC')->get();
        return view('frontend.userdashboard.order_page',compact('orders'));
    }//end method

    public function UserOrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();

        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('frontend.order.order_details',compact('order','orderItem'));

    }//end method

    public function UserInvoiceDownload($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->where('user_id',Auth::id())->first();

        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('frontend.order.order_invoice',compact('order','orderItem'))->setPaper('a4')->setOption([
            'temDir'=> public_path(),
            'chroot'=> public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }//end method


    public function ReturnOrder(Request $request, $order_id){

        Order::findOrFail($order_id)->update([
            'return_date' => Carbon::now()->format('d F Y'),
            'return_reason' => $request->return_reason,
            'return_order' => 1,
        ]);

        $notification = array(
            'message' => 'Return Request Send Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('user.order.page')->with($notification);


    }// end method

    public function ReturnOrderPage(){

        $orders= Order::where('user_id',Auth::id())->where('return_reason','!=', NULL)->orderBy('id','DESC')->get();

        return view('frontend.order.return_order',compact('orders'));

    }//end method

    public function UserOrderTracking(){
        return view('frontend.userdashboard.order_tracking');
    }// end method


    public function OrderTrack(Request $request){

        $invoice= $request->code;
        $track= Order::where('invoice_no',$invoice)->first();

        if($track){
            return view('frontend.tracking.track_order', compact('track'));
        }else{
            $notification = array(
                'message' => 'INvoice Invalid',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }



    }// end method


}

