<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function PandingOrder(){
        $orders = Order::where('status','pending')->orderBy('id','DESC')->get();
        return view('backend.orders.pending_orders',compact('orders'));
    } // End Method

    public function AdminOrderDetails($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();

        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        return view('backend.orders.admin_order_details',compact('order','orderItem'));
    } // End Method

    public function AdminConfirmOrder(){

        $orders = Order::where('status','confirm')->orderBy('id','DESC')->get();
        return view('backend.orders.confirm_orders',compact('orders'));

    } // End Method

    public function AdminProcecingOrder(){

        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();
        return view('backend.orders.procecing_orders',compact('orders'));

    } // End Method
    public function AdminDeliverOrder(){

        $orders = Order::where('status','deliverd')->orderBy('id','DESC')->get();
        return view('backend.orders.delivered_orders',compact('orders'));

    } // End Method

    public function PandingToConfirm($order_id){

        Order::findOrFail($order_id)->update(['status' => 'confirm']);

        $notification = array(
            'message' => 'Order Confirm Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.confirmed.order')->with($notification);
    }//end method

    public function ConfirmToProcecing($order_id){

        Order::findOrFail($order_id)->update(['status' => 'processing']);

        $notification = array(
            'message' => 'Order Processing Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.procecing.order')->with($notification);
    }//end method


    public function ProcecingToDelivered($order_id){

        $product = OrderItem::where('order_id',$order_id)->get();

        foreach($product as $item){

        Product::where('id',$item->product_id)
                ->update(['product_qty' => DB::raw('product_qty-'.$item->qty) ]);
            }


        Order::findOrFail($order_id)->update(['status' => 'deliverd']);

        $notification = array(
            'message' => 'Order Delivered Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.deliver.order')->with($notification);
    }//end method

    public function AdminInvoiceDownload($order_id){

        $order = Order::with('division','district','state','user')->where('id',$order_id)->first();
        $orderItem = OrderItem::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('backend.orders.admin_order_invoice',compact('order','orderItem'))->setPaper('a4')->setOption([
            'temDir'=> public_path(),
            'chroot'=> public_path(),
        ]);
        return $pdf->download('invoice.pdf');

    }//end method


}
