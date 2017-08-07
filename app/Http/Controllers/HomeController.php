<?php

namespace App\Http\Controllers;

use App\Exchanger;
use App\Traits\ExportTrait;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    use ExportTrait;
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
    public function index(Request $request)
    {
        $top_widget = array();
        $top_widget['transactions_count'] = Transaction::filterBank('successful')->count();
        $top_widget['transactions_sum'] = Transaction::filterBank('successful')->filterFanex('accepted')->filterUpt('successful')->sum('payment_amount');
        $top_widget['users_count'] = Transaction::filterBank('successful')->distinct('user_id')->count('user_id');
        //todo : /nzh/biz/getFollowers , count

        $exchanger = Auth::user();
        $rate_euro = $exchanger->rates()->currency('1')->last();
        $rate_lira = $exchanger->rates()->currency('2')->last();
        $top_widget['euro_last_rate'] = $rate_euro->rate;
        $top_widget['lira_last_rate'] = $rate_lira->rate;

        $per = (isset($request['per'])) ? $request['per'] : 'daily';
        $today = array();

        $today['special'] = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->filterBank('successful')->filterFanex('accepted')->per($per)->orderBy('premium_amount', 'DESC')->limit(10)->get();
        $today['count'] = Transaction::filterBank('successful')->per($per)->count();
        $today['sum'] = Transaction::filterBank('successful')->per($per)->sum('payment_amount');

//        dd($today['special']->toArray());

        return view('home', compact('top_widget', 'today'));
    }

    public function special_transaction_excel(Request $request)
    {
        $transactions = $request->transactions;
//        $per = 'daily';
//        $transactions = $today['special'] = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->filterBank('successful')->filterFanex('accepted')->per($per)->orderBy('premium_amount', 'DESC')->limit(10)->get();

        $paymentsArray = [];

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['row number','reference_number', 'bank_status','fanex_status','upt_status','currency','rate',
            'premium_amount','payment_type','payment_date','country','upt_reference','updated_at','sender_firstname','sender_lastname'
            ,'beneficiary_firstname','beneficiary_lastname','account_number','bank_name','branch_address','iban','swift'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        $this->pdf_export($transactions,$paymentsArray,'special_transactions','Exchanger','FANEx');

    }
}
