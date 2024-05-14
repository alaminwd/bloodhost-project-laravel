<?php

namespace App\Http\Controllers;

use App\Models\Blood;
use App\Models\City;
use App\Models\DonerVerifyEmail;
use App\Models\Donation;
use App\Models\Donor;
use App\Models\DonorHistory;
use App\Models\Order;
use App\Models\Upazila;
use App\Notifications\DonerEmailVerifyNotification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Image;
use PDF;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Mail;

class DonorController extends Controller
{
     // donor register page
     function donor_register(){
        $bloods = Blood::all();
        return view('frontned.donor_register', [
            'bloods'=>$bloods,
        ]);
    }

    // donor registration
    function donor_store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|unique:donors',
            'phone'=>'required',
            'blood_id'=>'required',
            'password'=>'required',
        ]);
        
        $doner_id = Donor::insertGetId([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'blood_id'=>$request->blood_id,
            'password'=>Hash::make($request->password),
            'created_at'=>Carbon::now(),
        ]);

        // ============Email Verify ===========//
        $doner = Donor::find( $doner_id);
        // DonerVerifyEmail::where('doner_id', $doner->id )->delete(); //optional

        $info = DonerVerifyEmail::create([
            'doner_id'=>$doner_id,
            'token'=>uniqid(),
            'created_at'=>Carbon::now(),
        ]);

         Notification::send( $doner, new DonerEmailVerifyNotification ( $info));



        return back()->with('verify', 'we have sent you a email verification mail, your email please verify');


    }
    function donor_login_page(){
        return view('frontned.donor_login');
    }
    // donor login
    function donor_login(Request $request){
        $request->validate([
            'donor_email'=>'required',
            'donor_password'=>'required',
        ]);
        
        if(Auth::guard('donorlogin')->attempt(['email' => $request->donor_email, 'password'=>$request->donor_password])){
           
            if(Auth::guard('donorlogin')->user()->email_verified_at == null){
                
                Auth::guard('donorlogin')->logout();
                return back()->with('no_verify', 'Please Verify Your Email');
            }
            else{
                return redirect('/');
            }
        }
        else{
            return back()->with('wrong_info', 'Wrong credential');
        }
    }
  
    // donor logout
    function donor_logout(){
      Auth::guard('donorlogin')->logout();
      return redirect('/');
    }

    // Donor profile
    function donor_profile(){
        
        $donors = DonorHistory::where('donor_id', Auth::guard('donorlogin')->user()->id)->latest()->paginate(10);
        return view('frontned.donor_profile', [
            'donors'=>$donors,
        ]);
    }

    function edit_donor_profile(){
        $bloods = Blood::all();
        $cites = City::all() ;
        return view('frontned.edit_donor_profile', [
            'bloods'=>$bloods,
            'cites'=>$cites,
        ]);
    }

    // Donor profile update
    function donor_profile_update(Request $request){
        $request->validate([
            'donor_img'=>'mimes:png,jpg,jpeg',
        ]);
        if($request->donor_img == ''){
           if($request->password == ''){
              Donor::find(Auth::guard('donorlogin')->id())->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'address'=>$request->address,
                'phone'=>$request->phone,
                'city_id'=>$request->city_id,
                'subcity_id'=>$request->subcity_id,
                'blood_id'=>$request->blood,
                'gender'=>$request->gender,
                'religion'=>$request->religion,
                'birth_date'=>$request->birth_date,
              ]);
           }

           else{
             if(Hash::check($request->old_password, Auth::guard('donorlogin')->user()->password)){
                Donor::find(Auth::guard('donorlogin')->id())->update([
                    'name'=>$request->name,
                    'email'=>$request->email,
                    'password'=>bcrypt($request->password),
                    'address'=>$request->address,
                    'phone'=>$request->phone,
                    'city_id'=>$request->city_id,
                    'subcity_id'=>$request->subcity_id,
                    'blood_id'=>$request->blood,
                    'gender'=>$request->gender,
                    'religion'=>$request->religion,
                    'birth_date'=>$request->birth_date,
                  ]);
             }
             else{
                return back()->with('wrong', 'Old Password is wrong!');
             }
           }
        }

        else{
            $donor_img = $request->donor_img;
            $size = $donor_img->getSize();
            $extension = $donor_img->getClientOriginalExtension();
            $file_name = Auth::guard('donorlogin')->id().'.'.$extension;
            

            if($size < 2000000){
                if(Auth::guard('donorlogin')->user()->donor_img != null){
                    unlink(public_path('upload/donor/'.Auth::guard('donorlogin')->user()->donor_img));
                }
    
                Image::make($donor_img)->save(public_path('upload/donor/'.$file_name));
    
                if($request->password == ''){
                    Donor::find(Auth::guard('donorlogin')->id())->update([
                        'name'=>$request->name,
                        'email'=>$request->email,
                        'address'=>$request->address,
                        'phone'=>$request->phone,
                        'city_id'=>$request->city_id,
                        'subcity_id'=>$request->subcity_id,
                        'blood_id'=>$request->blood,
                        'gender'=>$request->gender,
                        'religion'=>$request->religion,
                        'birth_date'=>$request->birth_date,
                        'donor_img'=>$file_name,
                    ]);
                 }
      
                 else{
                   if(Hash::check($request->old_password, Auth::guard('donorlogin')->user()->password)){
                      Donor::find(Auth::guard('donorlogin')->id())->update([
                            'name'=>$request->name,
                            'email'=>$request->email,
                            'password'=>bcrypt($request->password),
                            'address'=>$request->address,
                            'phone'=>$request->phone,
                            'city_id'=>$request->city_id,
                            'subcity_id'=>$request->subcity_id,
                            'blood_id'=>$request->blood,
                            'gender'=>$request->gender,
                            'religion'=>$request->religion,
                            'birth_date'=>$request->birth_date,
                            'donor_img'=>$file_name,
                        ]);
                   }
                   else{
                      return back()->with('wrong', 'Old Password is wrong!');
                   }
                 }
            }
            else{
                return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
            }
          
        }

        return back()->with('succ', 'Your profile Successfully Updated');
    }


    // Donor List
    function donor(Request $request){
        $data = $request->all();
        $blood_info = Blood::all();
        $cities = City::all();
        $donors = Donor::where(function ($q) use ($data){
            if (!empty($data['blood_id']) && $data['blood_id'] != '' && $data['blood_id'] != 'undefined') {
                $q->where('blood_id', $data['blood_id']);
            }
            if (!empty($data['city_id']) && $data['city_id'] != '' && $data['city_id'] != 'undefined') {
                $q->where('city_id', $data['city_id']);
            }
            if (!empty($data['subcity_id']) && $data['subcity_id'] != '' && $data['subcity_id'] != 'undefined') {
                $q->where('subcity_id', $data['subcity_id']);
            }
        })->latest()->paginate(20);
        return view('frontned.donor', [
            'donors'=>$donors,
            'blood_info'=>$blood_info,
            'cities'=>$cities,
        ]);
    }
    function getSubcities(Request $request){
        $str = '<option value="">-- Select upazila --</option>';
         $subcities = Upazila::where('district_id', $request->city_id)->get();
         foreach($subcities as $subcity){
             $str.= '<option value="'.$subcity->id.'">'.$subcity->name.'</option>';
         }
         echo $str;
     }

    // Donation
    function donation(){
        $donations =  Donation::all();
        return view('admin.donation.donation', [
            'donations'=>$donations,
        ]);
    }

    // Donation delete
    function donation_delete($donate_id){
        Order::find($donate_id)->delete();
        return back();
    }

    // Donor download
    function donor_download(){

        $data = Donor::all();
        
        $pdf = PDF::loadView('admin.blood.download_donor', [
            'data'=>$data,
        ]);
        return $pdf->download('donorlist.pdf');
    }

// ===============email verify Process==========///

    function doner_email_verify($token){
        $doner = DonerVerifyEmail::where('token', $token)->firstOrFail();
        Donor::find($doner->doner_id)->update([
            'email_verified_at'=>Carbon::now(),
        ]);

       return redirect()->route('donor.login.page')->with('verify_success', 'Your Email Verify Successfully , Now Can Login');
    }

    function sent_email_verify_request(){
        return view('frontned.email_verify_Requst');
    }
    
    function email_verify_req_sent(Request $request){
        if(Donor::where('email', $request->email)->exists()){
            $doner = Donor::where('email', $request->email)->firstOrFail();
            DonerVerifyEmail::where('doner_id', $doner->id)->delete();
            $info = DonerVerifyEmail::create([
                'doner_id'=>$doner->id,
                'token'=>uniqid(),
                'created_at'=>Carbon::now(),
            ]);
            Notification::send( $doner, new DonerEmailVerifyNotification ( $info));
            return back()->with('verify', 'we have sent you a email verification mail, your email please verify');
        }
        else{
           return back()->with('register_now', 'You did not register yet !');
        }
    }

    // same donor
    function same_donor($blood_id){
        $blood_info = Donor::where('blood_id', $blood_id)->latest()->paginate(20);
        return view('frontned.same_donor', [
            'blood_info'=>$blood_info,
        ]);
    }

    

}
