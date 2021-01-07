<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class ActivityController extends Controller
{
    public function show($id){
        $activity = Activity::find($id);
        return view('activity.show',['activity'=>$activity]);
    }

    public function verification($id){
        $activity = Activity::find($id);
        return view('activity.verification',['activity'=>$activity]);
    }

    public function verify($id){
        $activity = Activity::find($id);
        $phone =request()->get('phone');
        $validator = Validator::make(['phone'=>$phone], [
            'phone'=>'regex:/^1[34578]\d{9}$/'
        ]);
        if ($validator->fails()) {
            return redirect()->back()
                ->withInput()
                ->withErrors($validator, 'actVerifyErrorBag');
        }
        $cus = Customer::where('phone',$phone)->first();
        if($cus){
            $activity->customers()->syncWithoutDetaching([$cus->id=>['status'=>1]]);
            return view('activity.verify_success');
        }else{
            return view('customer.create',['activity_id'=>$activity->id]);
        }
    }
}
