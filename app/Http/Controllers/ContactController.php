<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Contact;
use App\Models\Footer;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //Contact Page
    function contact(){
        $abouts = About::all();
        foreach($abouts as $about_info){
            $about_info;
        }
        $footers = Footer::all();
        foreach ($footers as $footer_info){
            $footer_info;
        }
        return view('frontned.contact', [
            'about_info'=>$about_info,
            'footer_info'=>$footer_info,
        ]);
    }

    // Message store
    function message_store(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email',
            'phone'=>'required',
            'mesg'=>'required',
        ]);

        Contact::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'mesg'=>$request->mesg,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('mesg_succ', 'Your Message Has been Sent');
        
    }


    // Message List
    function message(){
        $mesges = Contact::latest()->get();
        return view('admin.message.message', [
            'mesges'=>$mesges,
        ]);
    }

    // Message delete
    function mesg_delete($mesg_id){
       Contact::find($mesg_id)->delete();
       return back();
    }

    // Message view
    function message_view($mesg_id){
        Contact::find($mesg_id)->update([
            'status'=> 1,
        ]);

        $messege_info = Contact::find($mesg_id);
        return view('admin.message.view_message', [
            'messege_info'=>$messege_info,
        ]);
    }


    // Message solvation
    function message_solve($mesg_id){
        Contact::find($mesg_id)->update([
            'solve'=> 1,
        ]);
        return back();
    }

 
}
