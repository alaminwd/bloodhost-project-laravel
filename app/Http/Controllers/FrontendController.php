<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Banner;
use App\Models\Blog;
use App\Models\Blood;
use App\Models\Counter;
use App\Models\Donor;
use App\Models\DonorHistory;
use App\Models\FooterIcon;
use App\Models\Policy;
use App\Models\Review;
use App\Models\Term;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{

    // Index page
    function index(){
        $banner_info = Banner::all();
        foreach ($banner_info as $ban_info){
            $banner = $ban_info;
        }
        $about_info = About::all();
        foreach ($about_info as $ab_info){
            $about = $ab_info;
        }
        
        $bloods = Blood::all();
        $donors = Donor::latest()->get();
        $counters = Counter::all();
        $reviews = Review::latest()->get();
        $blogs = Blog::latest()->get();
        $latest_donor = DonorHistory::all();
        return view('frontned.index', [
        'banner'=>$banner,
        'bloods'=>$bloods,
        'donors'=>$donors,
        'about'=>$about,
        'counters'=>$counters,
        'reviews'=>$reviews,
        'blogs'=>$blogs,
        'latest_donor'=>$latest_donor,
      ]);
    }

    // Single Donor
    function donor_info($donor_id){
        $donor_info = Donor::find($donor_id);
        $donors = DonorHistory::where('donor_id', $donor_info->id)->latest()->paginate(10);
        if(Auth::guard('donorlogin')->id()){

            if(Auth::guard('donorlogin')->user()->address !=null && Auth::guard('donorlogin')->user()->city_id !=null && Auth::guard('donorlogin')->user()->subcity_id !=null && Auth::guard('donorlogin')->user()->gender !=null && Auth::guard('donorlogin')->user()->religion !=null && Auth::guard('donorlogin')->user()->birth_date !=null){
                return view('frontned.single_donor', [
                    'donor_info'=>$donor_info,
                    'donors'=>$donors,
                ]);

            }

            else{
                return redirect()->route('edit.donor.profile')->with('login_first', 'Please complete your profile if you want to see this page');
            }
            
        }
        else{
            return redirect()->route('donor.login.page')->with('login_first', 'Please login first if you want to see this page');
        }
    }

    // Single blog 
    function single_blog($blog_id){
        $blog_info = Blog::find($blog_id);
        $icons = FooterIcon::all();
        return view('frontned.single_blog', [
            'blog_info'=>$blog_info,
            'icons'=>$icons,
        ]);
    }
    

    // SSL Commerz
    function ssl_commerz(){
        return view('frontned.donate');
    }

    // Donate money
    function donate_money(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'address'=>'required',
            'phone'=>'required',
            'amount'=>'required',
        ]);
        $data = $request->all();
        return redirect('/pay')->with('data', $data);
    }

    // terms
    function term(){
        $terms = Term::all();
        foreach ($terms as $term){
            $term_info = $term;
        }
        return view('frontned.term', [
            'term_info'=>$term_info,
        ]);
    }

    // Privacy policy
    function policy(){
        $policies = Policy::all();
        foreach ($policies as $policy){
            $policy_info = $policy;
        }
        return view('frontned.policy', [
            'policy_info'=>$policy_info,
        ]);
    }

}
