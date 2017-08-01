<?php

namespace App\Http\Controllers;

use App\Transaction;
use Illuminate\Http\Request;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
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
//            ->per('daily')
//            ->orderBy('premium_amount', 'DESC')
            ->orderBy($order, $option)->paginate(5);

        if ($request->ajax())
            return response()->json(view('partials.history', compact('transactions', 'extraInfo'))->render());

        dd($transactions);
        return view('pages.history', compact('transactions', 'extraInfo'));

    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     * @internal param Transaction $transaction
     */
    public function show(Request $request , $id)
    {
        $transaction = Transaction::findOrFail($id);
        $client = $transaction->user;
        $beneficiary = $transaction->beneficiary;

        if ($request->ajax())
            return view('partials.ajax.factor',compact('transaction','client', 'beneficiary'));

        return view('users.factor',compact('transaction','client','beneficiary'));

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
