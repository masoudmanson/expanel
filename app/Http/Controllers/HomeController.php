<?php

namespace App\Http\Controllers;

use App\CurrencyExchange;
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
     */
    public function __construct()
    {
//        $this->middleware('auth');
        $this->middleware('checkToken');
        $this->middleware('checkUser');
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

        $currency_exchange = Auth::user()->currencyExchange;

        $rate_euro = $currency_exchange->rates()->currency('1')->last();
        $rate_lira = $currency_exchange->rates()->currency('2')->last();

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

        $per = (isset($request['per'])) ? $request['per'] : 'daily';
        $today = array();

        $today['special'] = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()
            ->filterBank('successful')
            ->filterFanex('accepted')
            ->per($per)
            ->orderBy('premium_amount', 'DESC')
            ->limit(10)
            ->get();

        $today['count'] = Transaction::filterBank('successful')->per($per)->count();
        $today['sum'] = Transaction::filterBank('successful')->per($per)->sum('payment_amount');

        if ($request->ajax())
            return response()->json(view('partials.specialTrans', compact('today'))->render());

        return view('home', compact('top_widget', 'today', 'euro_last_set_time', 'lira_last_set_time'));
    }

    public function special_transaction_excel(Request $request)
    {
        $per = (isset($request['per'])) ? $request['per'] : 'daily';
        $transactions = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->filterBank('successful')->filterFanex('accepted')->per($per)->orderBy('premium_amount', 'DESC')->limit(10)->get();

        $paymentsArray = [];

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['row_number','reference_number', 'bank_status','fanex_status','upt_status','currency','rate',
            'premium_amount','payment_type','payment_date','country','upt_reference','updated_at','sender_firstname','sender_lastname'
            ,'beneficiary_firstname','beneficiary_lastname','account_number','bank_name','branch_address','iban','swift'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        $this->excel_export($transactions,$paymentsArray,'special_transactions','Exchanger','FANEx');

    }
}
