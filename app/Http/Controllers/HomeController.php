<?php

namespace App\Http\Controllers;

use App\Exchanger;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $top_widget = array();
        $top_widget['transactions_count'] = Transaction::filterBank('successful')->count();
        $top_widget['transactions_sum'] = Transaction::filterBank('successful')->filterFanex('accepted')->filterUpt('successful')->sum('payment_amount');
        //todo : /nzh/biz/getFollowers , count
//        dd($transactions_sum);

        $exchanger = Auth::user();
        $rate_obj = $exchanger->rates()->last();
        $top_widget['my_last_rate'] = $rate_obj->rate;

//        $special_trans = Transaction::order()->get();


        return view('home' , compact('top_widget'));
    }
}
