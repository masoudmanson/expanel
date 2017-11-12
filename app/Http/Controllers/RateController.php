<?php

namespace App\Http\Controllers;

use App\Exchanger;
use App\User;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use jDate;

class RateController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('checkToken');
        $this->middleware('checkUser');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $currency_exchange = Auth::user()->currencyExchange;

        $rates = array();

        $rates['euro']['list'] = $currency_exchange->rates()->currency('EUR')->orderBy('rates.created_at')->paginate(10);
        $rates['euro']['max'] = $currency_exchange->rates()->currency('EUR')->get()->max('rate');
        $rates['euro']['min'] = $currency_exchange->rates()->currency('EUR')->get()->min('rate');
        $rates['lira']['list'] = $currency_exchange->rates()->currency('TRY')->orderBy('rates.created_at')->paginate(10);
        $rates['lira']['max'] = $currency_exchange->rates()->currency('TRY')->get()->max('rate');
        $rates['lira']['min'] = $currency_exchange->rates()->currency('TRY')->get()->min('rate');

        $rate_euro = $currency_exchange->rates()->currency('EUR')->last();

        $rate_lira = $currency_exchange->rates()->currency('TRY')->last();

        if(isset($rate_euro->rate)) {
            $euro_last_set_time = jdate($rate_euro->updated_at)->ago();
            $top_widget['euro_last_rate'] = $rate_euro->rate;
        }
        else {
            $top_widget['euro_last_rate'] = 0;
            $euro_last_set_time = 0;
        }
        if(isset($rate_lira->rate)) {
            $lira_last_set_time = jdate($rate_lira->updated_at)->ago();
            $top_widget['lira_last_rate'] = $rate_lira->rate;
        }
        else {
            $top_widget['lira_last_rate'] = 0;
            $lira_last_set_time = 0;
        }

        if ($request->ajax())
            return response()->json(view('partials.rateTables', compact('rates', 'top_widget','euro_last_set_time','lira_last_set_time'))->render());

        return view('pages.rate',compact('rates', 'top_widget','euro_last_set_time','lira_last_set_time'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['exchanger_user_id'] = Auth::user()->id;
        $request['ip'] = $request->ip();

        Rate::create($request->all());

        return redirect()->back();
    }
}
