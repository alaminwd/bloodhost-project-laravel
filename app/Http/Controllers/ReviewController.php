<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

class ReviewController extends Controller
{
    //Review page
    function review(){
        $reviews = Review::all();
        return view('admin.review.add_review', [
            'reviews'=>$reviews,
        ]);
    }

    // Review store
    function review_store(Request $request){
        $request->validate([
            'name'=>'required',
            'address'=>'required',
            'desp'=>'required',
            'picture'=>'required|mimes:png,jpg,jpeg',
        ]);
       
            $picture = $request->picture;
            $size = $picture->getSize();
            $extension = $picture->getClientOriginalExtension();
            $file_name = substr($request->name, 0, 3).'.'.$extension;

            if($size < 2000000){
                Image::make($picture)->save(public_path('upload/review/'.$file_name));
               
                Review::insert([
                    'name'=>$request->name,
                    'address'=>$request->address,
                    'desp'=>$request->desp,
                    'picture'=>$file_name,
                    'created_at'=>Carbon::now(),
                ]);
            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
            }
        
        return back()->with('review', 'Successfully added');
    }

    // Review delete
    function review_delete($review_id){
        $present_img = Review::find($review_id);
        unlink(public_path('upload/review/'.$present_img->picture));

        Review::find($review_id)->delete();
        return back();
    }

    // Review view
    function review_view($review_id){
        $review_info = Review::find($review_id);
        return view('admin.review.view_review', [
            'review_info'=>$review_info,
        ]);
    }
}
