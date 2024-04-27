<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\BlogCategory;
use App\Models\BlogPost;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;

class BlogController extends Controller
{
    public function AllBlogCategory(){
        $blogCategories= BlogCategory::latest()->get();
        return view('backend.blog.category.blog_all_category',compact('blogCategories'));
    }// end method


    public function AddBlogCategory(){

        return view('backend.blog.category.blog_add_category');
    }// end method

    public function StoreBlogCategory(Request $request){

        BlogCategory::insert([
            'blog_category_name'=> $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)),
            'created_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);

    }// end method


    public function EditBlogCategory($id){

        $blogCategory = BlogCategory::find($id);
        return view('backend.blog.category.blog_category_edit',compact('blogCategory'));

    }// end method


    public function UpdateBlogCategory(Request $request){

        $id= $request->id;
        BlogCategory::findOrFail($id)->update([
            'blog_category_name'=> $request->blog_category_name,
            'blog_category_slug' => strtolower(str_replace(' ', '-',$request->blog_category_name)),
            'updated_at' => Carbon::now(),
        ]);
        $notification = array(
            'message' => 'Blog Category Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);


    }// end method

    public function DeleteBlogCategory($id){

        BlogCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


    ////////////////////////// Blog Post start Here //////////////

    public function AllBlogPost(){
        $blogPost= BlogPost::latest()->get();
        return view('backend.blog.post.blog_post_all',compact('blogPost'));
    }// end method

    public function AddBlogPost(){
        $blogCategories= BlogCategory::latest()->get();
        return view('backend.blog.post.blog_post_add',compact('blogCategories'));
    }// end method

    public function StoreBlogPost(Request $request){

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1103,906)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;

        BlogPost::insert([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_short_descp' => $request->post_short_descp,
            'post_long_descp' => $request->post_long_descp,
            'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
            'post_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Blog Post Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.post')->with($notification);

    }// End Method

    public function EditBlogPost($id){

        $blogPost= BlogPost::find($id);
        $blogCategories= BlogCategory::latest()->get();

        return view('backend.blog.post.blog_post_edit',compact('blogPost','blogCategories'));

    }// end method

    public function UpdateBlogPost(Request $request){

        $id= $request->id;
        $old_img= $request->old_img;

        $image = $request->file('post_image');
        $name_gen = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(1103,906)->save('upload/blog/'.$name_gen);
        $save_url = 'upload/blog/'.$name_gen;

        if (file_exists($old_img)) {
            unlink($old_img);
         }

        BlogPost::findOrFail($id)->update([
            'category_id' => $request->category_id,
            'post_title' => $request->post_title,
            'post_short_descp' => $request->post_short_descp,
            'post_long_descp' => $request->post_long_descp,
            'post_slug' => strtolower(str_replace(' ', '-',$request->post_title)),
            'post_image' => $save_url,
        ]);

       $notification = array(
            'message' => 'Blog Post Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.post')->with($notification);

    }// End Method

    public function DeleteBlogPost($id){

        $blogpost = BlogPost::findOrFail($id);
        $img = $blogpost->post_image;
        unlink($img );

        BlogPost::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Blog Post Deleted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);

    }//end method


    //////////////////////// Frontend Blog Post ////////////////////

    public function HomeBlog(){

        $blogCategory= BlogCategory::latest()->get();
        $blogPost= BlogPost::latest()->get();

        return view('frontend.blog.home_blog',compact('blogCategory','blogPost'));

    }// end method

    public function BlogDetails($id, $slug){

        $blogCategory= BlogCategory::latest()->get();
        $blogPost= BlogPost::findOrFail($id);
        $bradcam= BlogCategory::where('id',$id)->get();
        return view('frontend.blog.blog_post_details',compact('blogCategory','blogPost','bradcam'));

    }// end method


    public function BlogCategory($id, $slug){

        $blogCategory= BlogCategory::latest()->get();
        $blogPost= BlogPost::where('id',$id)->latest()->get();
        $bradcam= BlogCategory::where('id',$id)->get();
        return view('frontend.blog.blog_category',compact('blogCategory','blogPost','bradcam'));

    }// end method



}
