<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Blog;
use Illuminate\Http\Request;
use Image;

class AboutController extends Controller
{
    //About Page
    function about_edit(){
        $abouts = About::all();
        foreach($abouts as $about_info){
            $about_info;
        }
        return view('admin.about.edit_about', [
            'about_info'=>$about_info,
        ]);
    }

    // About update
    function about_update(Request $request){
        $request->validate([
            'about_img'=>'mimes:png,jpg, jpeg',
        ]);
        
        if($request->about_img == ''){
            About::where('id', $request->about_id)->update([
                'title1'=>$request->title1,
                'desp1'=>$request->desp1,
                'title2'=>$request->title2,
                'desp2'=>$request->desp2,
                'title3'=>$request->title3,
                'desp3'=>$request->desp3,
                'title4'=>$request->title4,
                'desp4'=>$request->desp4,
                'address'=>$request->address,
            ]);
        }
        else{
            $ab_img = $request->about_img;
            $size = $ab_img->getSize();
            $extension = $ab_img->getClientOriginalExtension();
            $img_name = $request->about_img->getClientOriginalName();
            $file_name = substr($img_name, 0, 4).'.'.$extension;
            
            if($size < 2000000){
                $present_img = About::find($request->about_id);
                unlink(public_path('upload/about/'.$present_img->about_img));
    
                Image::make($ab_img)->save(public_path('upload/about/'.$file_name));
    
                About::where('id', $request->about_id)->update([
                    'title1'=>$request->title1,
                    'desp1'=>$request->desp1,
                    'title2'=>$request->title2,
                    'desp2'=>$request->desp2,
                    'title3'=>$request->title3,
                    'desp3'=>$request->desp3,
                    'title4'=>$request->title4,
                    'desp4'=>$request->desp4,
                    'address'=>$request->address,
                    'about_img'=>$file_name,
                ]);
            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
            }
            
        }

        return back()->with('ab_succ', 'About Info Successfully Updated');
    }


    // About US page
    function about(){
        $about_info = About::all();
        foreach ($about_info as $ab_info){
            $about = $ab_info;
        }
        $blogs = Blog::all();
        return view('frontned.about_us', [
            'about'=>$about,
            'blogs'=>$blogs,
        ]);
    }
}
