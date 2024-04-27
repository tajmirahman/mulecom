<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class WishlsitController extends Controller
{
    public function AddToWishlist(Request $request, $product_id){

        if (Auth::check()) {
            $exists = Wishlist::where('user_id',Auth::id())->where('product_id',$product_id)->first();

                  if (!$exists) {
                     Wishlist::insert([
                      'user_id' => Auth::id(),
                      'product_id' => $product_id,
                      'created_at' => Carbon::now(),

                     ]);
                     return response()->json(['success' => 'Successfully Added On Your Wishlist' ]);
                  } else{
                      return response()->json(['error' => 'This Product Has Already on Your Wishlist' ]);

                  }

              }else{
                  return response()->json(['error' => 'At First Login Your Account' ]);
              }


    }// end mehtod

    public function AllWishlist(){

        return view('frontend.wishlist.wishlist_view');

    }// end mehtod

    public function GetWishlistProduct(){

        $wishlist = Wishlist::with('product')->where('user_id',Auth::id())->latest()->get();

        $wishQty = wishlist::count();

        return response()->json(['wishlist'=> $wishlist, 'wishQty' => $wishQty]);

    }// End Method


    public function WishlistProductRemove($id){
        Wishlist::where('user_id',Auth::id())->where('id',$id)->delete();
        return response()->json(['success' => 'Successfully Product Remove' ]);
    }// End Method


}
