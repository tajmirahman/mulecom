<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\User;
use App\Models\SubCategory;
use App\Models\MultiImg;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;




class VendorProductController extends Controller
{
    public function VendorAllProduct(){
        $id=Auth::user()->id;
        $products=Product::where('vendor_id',$id)->latest()->get();
        return view('vendor.backend.product.vendor_product_all',compact('products'));

    }//end method


    public function VendorAddProduct(){

        $brands=Brand::orderBy('brand_name','ASC')->get();

        $categories=Category::orderBy('category_name','ASC')->get();

        return view('vendor.backend.product.vendor_product_add',compact('brands','categories'));

    }//end method

    public function VendorGetSubCategory($category_id){
        $subcat = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name','ASC')->get();
            return json_encode($subcat);

    }// End Method

    public function VendorStoreProduct(Request $request){

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        $product_id = Product::insertGetId([

            'brand_id'=>$request->brand_id,
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_slug'=>strtolower(str_replace(' ','-',$request->product_name,)),

            'product_code'=>$request->product_code,
            'product_qty'=>$request->product_qty,
            'product_tags'=>$request->product_tags,
            'product_size'=>$request->product_size,

            'product_color'=>$request->product_color,
            'discount_price'=>$request->discount_price,
            'selling_price'=>$request->selling_price,
            'short_dscp'=>$request->short_descp,
            'long_dscp'=>$request->long_descp,

            'hot_deals'=>$request->hot_deals,
            'featured'=>$request->featured,
            'special_offer'=>$request->special_offer,
            'special_deals'=>$request->special_deals,

            'product_thambnail'=>$save_url,
            'vendor_id'=>Auth::user()->id,
            'status'=>1,
            'created_at'=> Carbon::now(),

        ]);

        /// Multiple Image Upload From her //////

        $images = $request->file('multi_img');
        foreach($images as $img){
            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
        Image::make($img)->resize(800,800)->save('upload/products/multi-img/'.$make_name);
        $uploadPath = 'upload/products/multi-img/'.$make_name;


        MultiImg::insert([

            'product_id' => $product_id,
            'photo_name' => $uploadPath,
            'created_at' => Carbon::now(),

        ]);
        } // end foreach

        /// End Multiple Image Upload From her //////

        $notification = array(
            'message' => 'Vendor Product Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);


    }//end method


    public function VendorEditProduct($id){


        $multiImages= MultiImg::where('product_id',$id)->get();

        $brands=Brand::orderBy('brand_name','ASC')->get();

        $categories=Category::orderBy('category_name','ASC')->get();

        $subcategory=SubCategory::orderBy('subcategory_name','ASC')->get();

        $products=Product::find($id);

        return view('vendor.backend.product.vendor_product_edit',compact('brands','categories','subcategory','products','multiImages'));

    }//end method

    public function VendorProductUpdate(Request $request){
        $product_id= $request->id;

        Product::find($product_id)->update([

            'brand_id'=>$request->brand_id,
            'category_id'=>$request->category_id,
            'subcategory_id'=>$request->subcategory_id,
            'product_name'=>$request->product_name,
            'product_slug'=>strtolower(str_replace(' ','-',$request->product_name,)),

            'product_code'=>$request->product_code,
            'product_qty'=>$request->product_qty,
            'product_tags'=>$request->product_tags,
            'product_size'=>$request->product_size,

            'product_color'=>$request->product_color,
            'discount_price'=>$request->discount_price,
            'selling_price'=>$request->selling_price,
            'short_dscp'=>$request->short_descp,
            'long_dscp'=>$request->long_descp,

            'hot_deals'=>$request->hot_deals,
            'featured'=>$request->featured,
            'special_offer'=>$request->special_offer,
            'special_deals'=>$request->special_deals,

            'status'=>1,
            'created_at'=> Carbon::now(),

        ]);

        $notification = array(
            'message' => 'Without Image Vendor Product Update  Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('vendor.all.product')->with($notification);


    }//end method


    public function VendorUpdateThumbnail(Request $request){
        $product_id = $request->id;
        $old_image= $request->old_img;

        $image = $request->file('product_thambnail');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(800,800)->save('upload/products/thumbnail/'.$name_gen);
        $save_url = 'upload/products/thumbnail/'.$name_gen;

        if (file_exists($old_image)) {
            unlink($old_image);
         }

        Product::find($product_id)->update([
            'product_thambnail'=> $save_url,
        ]);

        $notification = array(
            'message' => 'Vendor Product Thumbnail Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



    }//end method


    public function VendorUpdateMultiImage(Request $request){

        $imgs= $request->multi_img;

        foreach ($imgs as $id => $img) {

            $imgReplace= MultiImg::find($id);

            unlink($imgReplace->photo_name);

            $make_name = hexdec(uniqid()).'.'.$img->getClientOriginalExtension();
            Image::make($img)->resize(800,800)->save('upload/products/multi-img/'.$make_name);
            $uploadPath = 'upload/products/multi-img/'.$make_name;

            MultiImg::where('id',$id)->update([
                'photo_name'=>$uploadPath,
                'updated_at'=> Carbon::now(),
            ]);

        }//end foreach

        $notification = array(
            'message' => 'Vendor Multi Image Update Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);






    }//end method

    public function VendorMultiImageDelete($id){
        $old_img=MultiImg::find($id);
        unlink($old_img->photo_name);

        MultiImg::find($id)->delete();

        $notification = array(
            'message' => 'Multi Image Delete Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


    public function VendorProductInactive($id){
        Product::find($id)->update(['status' => 0 ]);

        $notification = array(
            'message' => 'Product Inactive',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method

    public function VendorProductActive($id){
        Product::find($id)->update(['status' => 1 ]);

        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


    public function VendorProductDelete($id){

        $product= Product::find($id);
        unlink($product->product_thambnail);

        Product::find($id)->delete();


        $mul_img=MultiImg::where('product_id',$id)->get();

        foreach ($mul_img as $img) {
            unlink($img->photo_name);
            MultiImg::where('product_id',$id)->delete();
        }

        $notification = array(
            'message' => 'Product Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method




}
