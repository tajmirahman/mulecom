<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use DeepCopy\Filter\ReplaceFilter;
use Ramsey\Uuid\Type\Hexadecimal;
use Intervention\Image\Facades\Image;

class BannerController extends Controller
{
    public function AllBanner(){
        $banners=Banner::latest()->get();
        return view('backend.banner.banner_all',compact('banners'));
    }// End Method

    public function AddBanner(){
        return view('backend.banner.banner_add');
    }// End Method

    public function StoreBanner(Request $request){

        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;

        Banner::insert([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Banner Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification);

    }// End Method

    public function EditBanner($id){

        $banner = Banner::find($id);
        return view('backend.banner.banner_edit',compact('banner'));
    }// End Method

    public function UpdateBanner(Request $request){

        $bnr_id = $request->id;
        $old_img = $request->old_image;

        if ($request->file('banner_image')) {

        $image = $request->file('banner_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(768,450)->save('upload/banner/'.$name_gen);
        $save_url = 'upload/banner/'.$name_gen;

        if (file_exists($old_img)) {
           unlink($old_img);
        }

        Banner::find($bnr_id)->update([
            'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
            'banner_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Banner Updated with image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification);

        } else {

            Banner::find($bnr_id)->update([
                'banner_title' => $request->banner_title,
            'banner_url' => $request->banner_url,
        ]);

       $notification = array(
            'message' => 'Banner Updated without image Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.banner')->with($notification);

        } // end else

    }// End Method


    public function DeleteBanner($id){

        $banner= Banner::find($id);
        $img= $banner->banner_image;
        unlink($img);

        Banner::find($id)->delete();

        $notification = array(
            'message' => 'Banner Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method





}
