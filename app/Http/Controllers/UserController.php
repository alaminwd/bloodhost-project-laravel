<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;

class UserController extends Controller
{
    // User List

    function user(){
        $users = User::where('id', '!=', Auth::id())->get();
        $total_user = $users->count();
        return view('admin.user.user', [
            'users'=>$users,
            'total_user'=>$total_user,
        ]);
    }

    // User Delete

    function user_delete($user_id){
        $present_img = User::find($user_id);
        if($present_img->photo != null){
            unlink(public_path('upload/user/'.$present_img->photo));
        }
        User::find($user_id)->delete();
        return back()->with('user_del', 'User Deleted Succesfully');
    }

    // User Profile
    function user_profile(){
        return view('admin.user.profile');
    }

    // User profile Info Update

    function profile_update(Request $request){
        $request->validate([
            'email'=>'email',
        ]);
       User::find(Auth::id())->update([
        'name'=>$request->name,
        'email'=>$request->email,
       ]);
       return back()->withProfile_success('Your Info Successfully Updated');
    }

    // User profile Password Update
    function password_update(Request $request){
        $request->validate([
            'old_password'=>'required',
            'password'=>'required',
        ]);

        if(Hash::check($request->old_password, Auth::user()->password)){
            User::find(Auth::id())->update([
                'password'=>bcrypt($request->password),
            ]);
            return back()->with('pass_succ', 'Password successfully updated');
        }
        else{
            return back()->with('old_wrong', 'Your old password is incorrect');
        }
    }

    // User Profile picture update

    function photo_update(Request $request){
         $request->validate([
            'photo'=>'required|mimes:jpeg,png,jpg',
         ]);


         $photo = $request->photo;
         $size = $photo->getSize();
         $extension = $photo->getClientOriginalExtension();
         $file_name = Auth::id().'.'.$extension;
         
         if($size < 2000000){
            if(Auth::user()->photo != null){
                unlink(public_path('upload/user/'.Auth::user()->photo));
             }
             Image::make($photo)->save(public_path('upload/user/'.$file_name));
    
             User::find(Auth::id())->update([
                'photo'=>$file_name,
             ]);
         }
         else{
            return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
         }

         return back()->with('profile_photo', 'Your photo successfully updated');
    }

}
