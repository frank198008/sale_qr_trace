<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function create()
    {
        return view('customer.create', \request()->all());
    }

    public function store(Request $request)
    {
        try {
            $act = Activity::find($request->get('activity_id'));
            $cus = Customer::where('phone', $request->get('phone'))->first();
            $attend = false;
            if ($cus) {
                if (count($act->customers()->where('id', $cus->id)->get())) {
                    //登记并已经参加了活动
                    $attend = true;
                }
            } else {
                $all = $request->all();
                $validator = Validator::make($all, [
                    'name' => 'required|min:2',
                    'phone' => 'required|regex:/^1[34578]\d{9}$/'
                ]);

                if ($validator->fails()) {
                    return redirect()->back()
                        ->withInput()
                        ->withErrors($validator, 'createCusErrorBag');
                }
                $cus = Customer::create($request->all());
            }
            if (!$attend) {
                $act->customers()->attach($cus->id, ['salesman_id_register' => $request->get('salesman_id')]);
            }
            return view('customer.create_success', ['activity' => $act, 'customer' => $cus]);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back();
        }
    }

    public function update($id)
    {
        try {
            $cus = Customer::find($id);
            $all = \request()->all();
            $validator = Validator::make($all, [
                'name' => 'required|min:2',
                'phone' => 'required|regex:/^1[34578]\d{9}$/|unique:customers'
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withInput()
                    ->withErrors($validator, 'updateCusErrorBag');
            }
            $cus->update($all);
            return view('customer.create_success', ['customer' => $cus]);

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return redirect()->back();

        }
    }

    public function edit($id)
    {
        $cus = Customer::find($id);
        return view('customer.update', $cus->toArray());
    }
}
