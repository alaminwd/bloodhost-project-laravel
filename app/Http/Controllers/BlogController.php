<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class BlogController extends Controller
{
    //Blog Page
    function add_blog(){
        return view('admin.blog.blog');
    }

    // Blog store
    function blog_store(Request $request){
        $request->validate([
            'title'=>'required',
            'desp'=>'required',
            'img'=>'required|mimes:png,jpg,jprg',
        ]);

        $random = random_int(100, 9999);
        $blog_img = $request->img;
        $size = $blog_img->getSize();
        $img_name = $request->img->getClientOriginalName();
        $extension = $blog_img->getClientOriginalExtension();
        $file_name = substr($img_name, 0, 3).$random.'.'.$extension;

        if($size < 2000000){
            Image::make($blog_img)->save(public_path('upload/blog/'.$file_name));
    
            Blog::insert([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'img'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{
            return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
        }
        return back()->with('blog', 'Blog Successfully Posted');
    }

    // View blog
    function view_blog(){
        $blogs = Blog::latest()->paginate(15);
        return view('admin.blog.blog_view', [
            'blogs'=>$blogs,
        ]);
    }

    // Blog delete
    function blog_delete($blog_id){
        $present_img = Blog::find($blog_id);
        unlink(public_path('upload/blog/'.$present_img->img));

        Blog::find($blog_id)->delete();
        return back();
    }

    // Blog Page
    function blog(){
        $blogs = Blog::latest()->paginate(9);
        return view('frontned.blog_page', [
            'blogs'=>$blogs,
        ]);
    }

    // blog edit
    function blog_edit($blog_id){
        $blog_info = Blog::find($blog_id);
        return view('admin.blog.blog_edit', [
            'blog_info'=>$blog_info,
        ]);
    }

    // blog update
    function blog_update(Request $request){

        $request->validate([
            'img'=>'mimes:png,jpg,jprg',
        ]);

        if($request->img == ''){
             Blog::find($request->blog_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
             ]);
        }
        else{

            $random = random_int(100, 9999);
            $blog_img = $request->img;
            $img_name = $request->img->getClientOriginalName();
            $extension = $blog_img->getClientOriginalExtension();
            $file_name = substr($img_name, 0, 3).$random.'.'.$extension;

            $present_img = Blog::find($request->blog_id);
            unlink(public_path('upload/blog/'.$present_img->img));

            Image::make($blog_img)->save(public_path('upload/blog/'.$file_name));
    
            Blog::find($request->blog_id)->update([
                'title'=>$request->title,
                'desp'=>$request->desp,
                'img'=>$file_name,
            ]);
        }

        return back()->with('blog', 'Blog Successfully Posted');
    }
}
