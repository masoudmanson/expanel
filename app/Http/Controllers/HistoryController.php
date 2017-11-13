<?php

namespace App\Http\Controllers;

use App\Traits\ExportTrait;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HistoryController extends Controller
{
    use ExportTrait;

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
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $order = trim($request->input('order'));
        $order = in_array($order, ['transactions.id', 'transactions.payment_amount', 'transactions.exchange_rate', 'transactions.payment_date']) ? $order : 'payment_date';

        if ($order != null) {
            $option = trim($request->input('option'));
        } else {
            $order = 'transactions.payment_date';
            $option = 'DESC';
        }
        $extraInfo['order'] = $order;
        $extraInfo['option'] = $option;


        $query = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()
            ->filterBank('successful');

        ($order == 'transactions.exchange_rate' || $order == 'transactions.payment_amount')?
            $transactions = $query->orderBy(DB::raw('CAST('.$order.' AS FLOAT)'), $option)->paginate(10):
            $transactions = $query->orderBy($order, $option)->paginate(10);

        $top_widget = array();
        $top_widget['transactions_count'] = $transactions->count();
        $top_widget['transactions_sum'] = $transactions->sum();

        $top_widget['transactions_count'] = Transaction::filterBank('successful')->count();
        $top_widget['transactions_sum_received'] = Transaction::filterBank('successful')->sum('payment_amount');
        $top_widget['transactions_sum_accepted'] = Transaction::filterBank('successful')->filterFanex('accepted')->sum('payment_amount');
        $top_widget['transactions_sum_done'] = Transaction::filterBank('successful')->filterFanex('accepted')->filterUpt('successful')->sum('payment_amount');

        if ($request->ajax())
            return response()->json(view('partials.history-table', compact('transactions', 'extraInfo'))->render());

        return view('pages.history', compact('transactions', 'extraInfo', 'top_widget'));

    }

    public function search(Request $request)
    {
        if ($request['order'] != null) {
            $order = $request['order'];
            $option = $request ['option'];
        } else {
            $order = 'transactions.id';
            $option = 'DESC';
        }

        $extraInfo['order'] = $order;
        $extraInfo['option'] = $option;

//        preg_match_all('/(?:(name|phone|account):)([^: ]+(?:\s+[^: ]+\b(?!:))*)/xi', $request->keyword, $matches, PREG_SET_ORDER);
        $keyword = $request->keyword;
//        $result = array();
//        foreach ($matches as $match) {
//            if (isset($result[$match[1]])) {
//                $result[$match[1]] = $result[$match[1]] . ' ' . $match[2];
//            } else
//                $result[$match[1]] = $match[2];
//        }
//
//        if ($result) {
//            $transactions = Transaction::joinUsers()
//                ->joinBeneficiaries()
//                ->selectBoth()
//                ->filterBank('successful')
//                ->where(function ($query) use ($result) {
//                    foreach ($result as $k => $v) {
//                        switch (strtolower($k)) {
//                            case 'name':
//                                $exploded = explode(' ', $v);
//                                $name = array_shift($exploded);
//                                $query->whereRaw("regexp_like(beneficiaries.firstname, '$name', 'i')")
//                                    ->orWhereRaw("regexp_like(users.firstname, '$name', 'i')");
//                                if (count($exploded) > 0) {
//                                    foreach ($exploded as $name) {
//                                        if (preg_match("/^[a-zA-Z\s]+$/", $name)) {
//                                            $query->where(function ($query) use ($name) {
//                                                $query->orWhereRaw("regexp_like(beneficiaries.firstname, '$name', 'i')")
//                                                    ->orWhereRaw("regexp_like(users.firstname, '$name', 'i')");
//                                            });
//                                        }
//                                    }
//                                }
//
//                            case 'phone':
//                                $exploded = explode(' ', $v);
//                                $phone = array_shift($exploded);
//                                if (ctype_digit($phone)) {
//                                    $query->whereRaw("regexp_like(beneficiaries.tel, '$phone', 'i')");
//                                    if (count($exploded) > 0) {
//                                        foreach ($exploded as $phone) {
//                                            if (ctype_digit($phone)) {
//                                                $query->where(function ($query) use ($phone) {
//                                                    $query->orWhereRaw("regexp_like(beneficiaries.tel, '$phone', 'i')");
//                                                });
//                                            }
//                                        }
//                                    }
//                                }
//                                break;
//
//                            case 'account':
//                                $exploded = explode(' ', $v);
//                                $account = array_shift($exploded);
//                                if (ctype_digit($account)) {
//                                    $query->whereRaw("regexp_like(beneficiaries.account_number, '$account', 'i')");
//                                    if (count($exploded) > 0) {
//                                        foreach ($exploded as $account) {
//                                            if (ctype_digit($account)) {
//                                                $query->where(function ($query) use ($account) {
//                                                    $query->orWhereRaw("regexp_like(beneficiaries.account_number, '$account', 'i')");
//                                                });
//                                            }
//                                        }
//                                    }
//                                }
//                                break;
//                            default:
//                                $query->where('id', 0);
//                                break;
//                        }
//                    }
//
//                })->paginate(10);
//
//        } else {
            $transactions = Transaction::joinUsers()
                ->joinBeneficiaries()
                ->selectBoth()
                ->filterBank('successful')
                ->where(function ($query) use ($keyword) {
                    $query->where('transactions.uri', 'like', "%$keyword%")
                        ->orWhereRaw("regexp_like(users.firstname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(users.lastname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(beneficiaries.firstname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(beneficiaries.lastname, '$keyword', 'i')")
                        ->orWhere('transactions.premium_amount', 'like', "%$keyword%");
                })->orderby("transactions.id", "desc")->paginate(10);
//        }

        if ($request->ajax())
            return response()->json(view('partials.history-table', compact('transactions', 'extraInfo'))->render());
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

    public function historyExcel()
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
            ->orderBy($order, $option)->get();
        $paymentsArray = [];

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['reference_number', 'bank_status','fanex_status','upt_status','currency','rate',
            'premium_amount','payment_type','payment_date','country','upt_reference','updated_at','sender_firstname','sender_lastname'
            ,'identity_number','tel_number','beneficiary_firstname','beneficiary_lastname','account_number','bank_name','branch_address','iban','swift'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        $this->excel_export($transactions,$paymentsArray,'special_transactions','Exchanger','FANEx');
    }
}
