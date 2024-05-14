<?php

namespace App\Http\Controllers;

use App\Models\Blood;
use App\Models\Donation;
use App\Models\DonationImage;
use App\Models\Donor;
use App\Models\DonorHistory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PDF;
use Image;

class BloodController extends Controller
{
    // blood List
    function blood(){
        $bloods = Blood::all();
        return view('admin.blood.blood_list', [
            'bloods'=>$bloods,
        ]);
    }

    // blood group store
    function group_store(Request $request){
        $request->validate([
            'blood_group'=>'required|unique:bloods',
        ]);

        Blood::insert([
            'blood_group'=>$request->blood_group,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('blood_succ', 'Successfully blood gorup added');
    }

    // Blood delete
    function blood_delete($blood_id){
        Blood::find($blood_id)->delete();
        return back()->with('blood_del', 'Blood group Successfully Deleted');
    }

    // Blood Donor List
    function donor_list(){
        $donors = Donor::latest()->paginate(20);
        return view('admin.blood.blood_donor', [
            'donors'=>$donors,
        ]);
    }

    // Donor view
    function donor_view($donor_id){
        $donor_info = Donor::find($donor_id);
        return view('admin.blood.donor_info', [
            'donor_info'=>$donor_info,
        ]);
    }

    // Donor delete
    function donor_delete($donor_id){
        $present_img = Donor::find($donor_id);

        if($present_img->donor_img!=null){
            unlink(public_path('upload/donor/'.$present_img->donor_img));
        }

        Donor::find($donor_id)->delete();
        return back();
    }
    function donor_history_details($donor_id){
        $history_info = DonorHistory::find($donor_id);
        $images = DonationImage::where('history_id',$donor_id)->get();
        return view('admin.blood.donor_history_details', [
            'history_info'=>$history_info,
            'images'=>$images,
        ]);
    }

    function donation_img_delete($image_id){
        $present_image = DonationImage::find($image_id);
        unlink(public_path('upload/history/'.$present_image->donation_img));
        DonationImage::find($image_id)->delete();
        return back();
    }

    function donor_history($donor_id){
        $donor_info = DonorHistory::where('donor_id', $donor_id)->latest()->get();
        $donors = Donor::find($donor_id);
        return view('admin.blood.donor_history',[
            'donors'=>$donors,
            'donor_info'=>$donor_info,
        ]);
    }

    function donor_history_store(Request $request){

        $request->validate([
            'reciever_name'=>'required',
            'reciever_number'=>'required',
            'hospital_name'=>'required',
            'hospital_address'=>'required',
            'donate_date'=>'required',
        ]);
        $history_id = DonorHistory::insertGetId([
           'donor_id'=>$request->donor_id,
           'reciever_name'=>$request->reciever_name,
           'reciever_number'=>$request->reciever_number,
           'hospital_name'=>$request->hospital_name,
           'hospital_address'=>$request->hospital_address,
           'donate_date'=>$request->donate_date,
           'created_at'=>Carbon::now(),
            
        ]);
        $random = random_int(10, 999);
        $donation_images = $request->donation_img;
        if($donation_images != ''){
            foreach($donation_images as $sl=>$images){
                $extn_img = $images->getClientOriginalExtension();
                $file_name = $history_id.'_'.$random.$sl.'.'.$extn_img;
    
               Image::make($images)->save(public_path('upload/history/'.$file_name));
               DonationImage::insert([
                'history_id'=>$history_id,
                'donation_img'=>$file_name,
                'created_at'=>Carbon::now(),
               ]);
             }
        }
        return back();
    }

    function donor_history_delete($donor_id){
       
        $present_image = DonationImage::where('history_id', $donor_id)->get();
        
        foreach($present_image as $image){
            if($image->donation_img!=null){
                unlink(public_path('upload/history/'.$image->donation_img));
            }

            DonationImage::where('history_id', $image->history_id)->delete();
        }

        DonorHistory::find($donor_id)->delete();

        return back();
    }

    function donor_history_download($donor_id){

        $data = DonorHistory::where('donor_id', $donor_id)->latest()->get();
        
        $pdf = PDF::loadView('admin.blood.download_donor_history', [
            'data'=>$data,
        ]);
        return $pdf->download('donorhistory.pdf');
    }
}
