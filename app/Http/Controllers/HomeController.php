<?php

namespace App\Http\Controllers;

use App\Models\Salesman;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sid = Auth::user()->salesman->id;
        $acts = Salesman::find($sid)->activities;
        switch (count($acts)) {
            case 0:
                return view('activity.no_activity');
            case 1:
                $act = $acts[0];
                $url = URL::to('/') . "/customer/create?salesman_id=$sid&activity_id=$act->id";

//                $image = QrCode::format('png')
//                    ->merge(public_path('img/boy.png'), 0.2, true)
//                    ->backgroundColor(255,55,0)
//                    ->margin(5)
//                    ->size(300)->errorCorrection('H')
//                    ->generate($url);
//                return response($image)->header('Content-type','image/png');
                return view('home', ['url' => $url,'activity'=>$act]);

            default:
                return view('activity.my_activities', ['activities' => $acts, 'salesman_id' => $sid]);
        }
    }
}
