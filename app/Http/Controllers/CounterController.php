<?php

namespace App\Http\Controllers;

use App\Models\Counter;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CounterController extends Controller
{
    //Counter
    function counter(){
        $counters = Counter::all();
        return view('admin.counter.counter', [
            'counters'=>$counters,
        ]);
    }

    // Counter store
    function counter_store(Request $request){
        $request->validate([
            'icon'=>'required',
            'number'=>'required',
            'title'=>'required',
        ]);

        Counter::insert([
            'icon'=>$request->icon,
            'number'=>$request->number,
            'title'=>$request->title,
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('counter', 'Counter added Successfully');
    }

    // Counter delete
    function counter_delete($counter_id){
        Counter::find($counter_id)->delete();
        return back();
    }

    // Counter Edit
    function counter_edit($counter_id){
        $counter_info = Counter::find($counter_id);
        return view('admin.counter.edit_counter', [
            'counter_info'=>$counter_info,
        ]);
    }

    // Counter Update
    function counter_update(Request $request){
        Counter::where('id', $request->counter_id)->update([
            'icon'=>$request->icon,
            'number'=>$request->number,
            'title'=>$request->title,
        ]);
        return back();
    }
}
