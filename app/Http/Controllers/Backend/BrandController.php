<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;
use DeepCopy\Filter\ReplaceFilter;
use Ramsey\Uuid\Type\Hexadecimal;
use Intervention\Image\Facades\Image;

class BrandController extends Controller
{
   public function AllBrand(){
    $brands=Brand::latest()->get();
    return view('backend.brand.all_brand',compact('brands'));

   }//end method

   public function AddBrand(){

    return view('backend.brand.add_brand');

   }//end method
   public function StoreBrand(Request $request){

    $image=$request->file('brand_image');
    $img_gen= date('Y').'.'.$image->getClientOriginalName();
    Image::make($image)->resize(500,500)->save('upload/brand/'.$img_gen);
    $save_url='upload/brand/'.$img_gen;

    Brand::insert([
        'brand_name'=>$request->brand_name,
        'brand_slug'=>strtolower(str_replace(' ','-',$request->brand_name)),
        'brand_image'=>$save_url,
    ]);

    $notification = array(
        'message' => 'Brand Inserted Successfully',
        'alert-type' => 'success'
    );
    return redirect()->route('all.brand')->with($notification);

   }//end method

   public function EditBrand($id){

    $brands=Brand::find($id);

    return view('backend.brand.edit_brand',compact('brands'));



   }//end method

   public function UpdateBrand(Request $request){
        $brand_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('brand_image')) {

        $image = $request->file('brand_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('upload/brand/'.$name_gen);
        $save_url = 'upload/brand/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Brand::find($brand_id)->update([
            'brand_name' => $request->brand_name,
            'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
            'brand_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Brand Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);

        } else {

             Brand::find($brand_id)->update([
                'brand_name' => $request->brand_name,
                'brand_slug' => strtolower(str_replace(' ', '-',$request->brand_name)),
        ]);

       $notification = array(
            'message' => 'Brand Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.brand')->with($notification);

        } // end else

    }// End Method

    public function DeleteBrand($id){

        $brnd=Brand::find($id);
        $img=$brnd->brand_image;
        unlink($img);

        Brand::find($id)->delete();

        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);



       }//end method






}
