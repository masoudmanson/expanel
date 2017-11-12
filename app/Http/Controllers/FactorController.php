<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class FactorController extends Controller
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
        if ($request['order'] != null) {
            $order = $request['order'];
            $option = $request ['option'];
        } else {
            $order = 'transactions.payment_date';
            $option = 'DESC';
        }

        $extraInfo['order'] = $order;
        $extraInfo['option'] = $option;

        $transactions = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()
            ->filterBank('successful')
            ->filterFanex('pending')
            ->orderBy($order, $option)->get();

        $transactions_done = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()
            ->filterBank('successful')
            ->filterFanex('accepted')
            ->orderBy($order, $option)->paginate(10);


        $top_widget['factors_unaccepted_count'] = 4;
        $top_widget['factors_accepted_count'] = 10;

        if ($request->ajax())
            return response()->json(view('partials.factors', compact('transactions', 'transactions_done', 'extraInfo', 'top_widget'))->render());

//        dd($transactions);
        return view('pages.factors', compact('transactions', 'transactions_done', 'extraInfo', 'top_widget'));
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $transactions = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->filterBank('successful')->filterFanex('pending')->orderBy('transactions.id','DESC')->paginate(10);

        $top_widget = array();
        $top_widget['transactions_count'] = 45;
        $top_widget['transactions_sum'] = 452000000;

        return view('pages.showTransaction', compact('transactions', 'top_widget'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
