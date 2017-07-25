<?php

namespace App\Http\Controllers;

use App\Exchanger;
use App\User;
use App\Rate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RateController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $exchanger = Auth::user();

        $rates = array();

        $rates['euro']['list'] = $exchanger->rates()->currency('1')->get();
        $rates['euro']['max'] = $exchanger->rates()->currency('1')->max('rate');
        $rates['euro']['min'] = $exchanger->rates()->currency('1')->min('rate');
        $rates['lira']['list'] = $exchanger->rates()->currency('2')->get();
        $rates['lira']['max'] = $exchanger->rates()->currency('2')->max('rate');
        $rates['lira']['min'] = $exchanger->rates()->currency('2')->min('rate');

        $rate_euro = $exchanger->rates()->currency('1')->last();
        $rate_lira = $exchanger->rates()->currency('2')->last();
        $top_widget['euro_last_rate'] = $rate_euro->rate;
        $top_widget['lira_last_rate'] = $rate_lira->rate;

        return view('pages.rate',compact('rates', 'top_widget'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request['exchanger_id'] = Auth::user()->id;

        Rate::create($request->all());

//        return redirect('rates');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
