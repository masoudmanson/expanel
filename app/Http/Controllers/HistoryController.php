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
            ->orderBy($order, $option)->paginate(10);

        $top_widget = array();
        $top_widget['transactions_count'] = $transactions->count();
        $top_widget['transactions_sum'] = $transactions->sum();

        $top_widget['transactions_count'] = Transaction::filterBank('successful')->count();
        $top_widget['transactions_sum_received'] = Transaction::filterBank('successful')->sum('payment_amount');
        $top_widget['transactions_sum_accepted'] = Transaction::filterBank('successful')->filterFanex('accepted')->sum('payment_amount');
        $top_widget['transactions_sum_done'] = Transaction::filterBank('successful')->filterFanex('accepted')->filterUpt('successful')->sum('payment_amount');

        if ($request->ajax())
            return response()->json(view('partials.history', compact('transactions', 'extraInfo'))->render());

//        dd($transactions);
        return view('pages.history', compact('transactions', 'extraInfo', 'top_widget'));

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

    public function excel()
    {
//        if ($request['order'] != null) {
//            $order = $request['order'];
//            $option = $request ['option'];
//        } else {
            $order = 'transactions.payment_date';
            $option = 'DESC';
//        }

        $extraInfo['order'] = $order;
        $extraInfo['option'] = $option;

        $transactions = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()
            ->filterBank('successful')
//            ->per('daily')
//            ->orderBy('premium_amount', 'DESC')
            ->orderBy($order, $option);

        dd($transactions);

        $paymentsArray = [];

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['row_number','reference_number', 'bank_status','fanex_status','upt_status','currency','rate',
            'premium_amount','payment_type','payment_date','country','upt_reference','updated_at','sender_firstname','sender_lastname'
            ,'beneficiary_firstname','beneficiary_lastname','account_number','bank_name','branch_address','iban','swift'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        $this->excel_export($transactions,$paymentsArray,'special_transactions','Exchanger','FANEx');
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
