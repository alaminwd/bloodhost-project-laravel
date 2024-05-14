<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\FooterIcon;
use App\Models\FooterImage;
use App\Models\Policy;
use App\Models\Term;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image;

use function Ramsey\Uuid\v1;

class FooterController extends Controller
{
    // Footer Info
    function footer(){
        $footers = Footer::all();
        foreach ($footers as $footer_info){
            $footer_info;
        }
        return view('admin.footer.edit_footer', [
            'footer_info'=>$footer_info,
        ]);
    }

    // footer update
    function footer_update(Request $request){
        if($request->footer_logo == ''){
            Footer::where('id', $request->footer_id)->update([
                'number'=>$request->number,
                'whatsapp'=>$request->whatsapp,
                'facebook'=>$request->facebook,
                'email'=>$request->email,
                'website'=>$request->website,
                'desp'=>$request->desp,
            ]);
        }

        else{
            $request->validate([
                'footer_logo'=>'mimes:png',
            ]);

            
            $logo = $request->footer_logo;
            $size = $logo->getSize();
            $extension = $logo->getClientOriginalExtension();
            $file_name = $request->footer_id.'.'.$extension;
            

            if($size < 2000000){
                $present_logo = Footer::find($request->footer_id);
                if($present_logo->footer_logo != null){
                    unlink(public_path('upload/footer/'.$present_logo->footer_logo));
                }
                Image::make($request->footer_logo)->save(public_path('upload/footer/'.$file_name));
      
                Footer::where('id', $request->footer_id)->update([
                    'number'=>$request->number,
                    'whatsapp'=>$request->whatsapp,
                    'facebook'=>$request->facebook,
                    'email'=>$request->email,
                    'website'=>$request->website,
                    'desp'=>$request->desp,
                    'footer_logo'=>$file_name,
                ]);
            }
            else{
                return back()->with('photo_error', 'The logo field must not be greater than 2mb.');
            }
        }
        return back()->withFooter('Footer logo updated successfully!');
    }

    // Footer Icon
    function footer_icon(){
        $icons = FooterIcon::all();
        $foot_imgs = FooterImage::all();
        return view('admin.footer.footer_icon_img', [
            'icons'=>$icons,
            'foot_imgs'=>$foot_imgs,
        ]);
    }

    // Footer icon store
    function footer_icon_store(Request $request){
        $request->validate([
            'icon'=>'required',
        ]);

        FooterIcon::insert([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('sersucc', 'Successfully Icon added');
    }

    // Footer Icon Edit
    function footer_icon_edit($icon_id){
        $icon_info = FooterIcon::find($icon_id);
        return view('admin.footer.edit_footer_icon', [
            'icon_info'=>$icon_info,
        ]);
    }

    // Footer Icon update
    function footer_icon_update(Request $request){
        FooterIcon::where('id', $request->icon_id)->update([
            'icon'=>$request->icon,
            'icon_link'=>$request->icon_link,
        ]);
        return back()->with('sersucc', 'Icon successfully Updated');
    }

    // Footer Icon delete
    function footer_icon_delete($icon_id){
        FooterIcon::find($icon_id)->delete();
        return back()->with('serdel', 'Icon Successfully Deleted');
    }

    // Footer img Store
    function footer_img_store(Request $request){
        $request->validate([
            'foot_img'=>'required|mimes:png,jpg',
            'foot_img_link'=>'required',
        ]);

        $random = random_int(100, 9999);
        $foot_img = $request->foot_img;
        $size = $foot_img->getSize();
        $extension = $foot_img->getClientOriginalExtension();
        $file_name2 = $random.'.'.$extension;

        if($size < 2000000){
            Image::make($request->foot_img)->save(public_path('upload/footer/'.$file_name2));
    
            FooterImage::insert([
                'foot_img'=>$file_name2,
                'foot_img_link'=>$request->foot_img_link,
                'created_at'=>Carbon::now(),
            ]);
        }
        else{
            return back()->with('photo_error', 'The photo field must not be greater than 2mb.');
        }
        return back();
    }

    // Footer Image Delete
    function foot_img_delete($img_id){
        $present_img = FooterImage::find($img_id);
        unlink(public_path('upload/footer/'.$present_img->foot_img));
        
        FooterImage::find($img_id)->delete();
        return back();
    }

    // edit terms
    function edit_term(){
        $terms = Term::all();
        foreach ($terms as $term){
            $term_info = $term;
        }
        return view('admin.footer.edit_term', [
            'term_info'=>$term_info,
        ]);
    }

    // terms update
    function term_update(Request $request){
        Term::find($request->term_id)->update([
            'term'=>$request->term,
        ]);

        return back();
    }

    // Edit Policy

    function edit_policy(){
        $policies = Policy::all();
        foreach ($policies as $policy){
            $policy_info = $policy;
        }
        return view('admin.footer.edit_policy', [
            'policy_info'=>$policy_info
        ]);
    }

    // policy update
    function policy_update(Request $request){
        Policy::find($request->policy_id)->update([
            'desp'=>$request->desp,
        ]);

        return back();
    }
    
}
