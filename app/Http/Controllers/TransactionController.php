<?php

namespace App\Http\Controllers;

use App\Traits\ExportTrait;
use App\Traits\PlatformTrait;
use App\Traits\UptTrait;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

class TransactionController extends Controller
{
    use PlatformTrait;
    use UptTrait;
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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
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

        $top_widget = array();
        $top_widget['transactions_count'] = Transaction::filterBank('successful')->per('daily')->count();
        $top_widget['transactions_sum'] = Transaction::filterBank('successful')->per('daily')->sum('payment_amount');
        $payed_transactions = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->filterBank('successful')->filterFanex('pending')->per('daily')->orderBy($order, $option)->paginate(10); //todo : for test try it with 'canceled' and 'rejected'
        if ($request->ajax())
            return response()->json(view('partials.search-transactions', compact('payed_transactions', 'extraInfo'))->render());

        return view('pages.transactions', compact('payed_transactions', 'top_widget', 'extraInfo'));
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

        $keyword = $request->keyword;

            $transactions = Transaction::joinUsers()
                ->joinBeneficiaries()
                ->selectBoth()
                ->filterBank('successful')
                ->filterFanex('pending')
                ->per('daily')
                ->where(function ($query) use ($keyword) {
                    $query->where('transactions.uri', 'like', "%$keyword%")
                        ->orWhereRaw("regexp_like(users.firstname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(users.lastname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(beneficiaries.firstname, '$keyword', 'i')")
                        ->orWhereRaw("regexp_like(beneficiaries.lastname, '$keyword', 'i')")
                        ->orWhere('transactions.premium_amount', 'like', "%$keyword%");
                })->orderby("transactions.id", "desc")->paginate(10);

        $payed_transactions = $transactions;

        if ($request->ajax())
            return response()->json(view('partials.search-transactions', compact('payed_transactions', 'extraInfo'))->render());
        else {
            $top_widget = array();
            $top_widget['transactions_count'] = Transaction::filterBank('successful')->per('daily')->count();
            $top_widget['transactions_sum'] = Transaction::filterBank('successful')->per('daily')->sum('payment_amount');
            return view('pages.transactions', compact('top_widget', 'payed_transactions', 'extraInfo'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $transaction)
    {
        $transaction = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->where('transactions.id', $transaction)->first();
        if ($request->ajax())
            return response()->json(view('partials.singleTrans', compact('transaction'))->render());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
//        dd($request);
        if ($request->confirmed) {
            $upt_res = $this->CorpSendRequest($transaction, $transaction->user, $transaction->beneficiary, $transaction->backlog);// todo : it must written after fanex admin

            if ($upt_res->CorpSendRequestResult->TransferRequestStatus->RESPONSE == 'Success') {
                $transaction->fanex_status = 'accepted';
                $transaction->upt_ref = $upt_res->CorpSendRequestResult->TU_REFNUMBER_OUT;

                $result = $this->CorpSendRequestConfirm($upt_res->CorpSendRequestResult->TU_REFNUMBER_OUT);

                if ($result->CorpSendRequestConfirmResult->TransferConfirmStatus->RESPONSE == 'Success') {
                    $transaction->upt_status = 'successful';
                    $transaction->update();

                } else {
                    $transaction->upt_status = 'failed'; //or rejected?
                    $transaction->fanex_status = 'pending';
                    $transaction->update();
//                  $this->CorpCancelRequest($upt_res->CorpSendRequestResult->TU_REFNUMBER_OUT);
//                  $this->CorpCancelConfirm($upt_res->CorpSendRequestResult->TU_REFNUMBER_OUT); // todo: check it later
                    return json_encode(array('status' => false, 'msg' => 'تایید ارسال حواله با خطا روبرو شد')); //upt request has problem.
                }
            } else {
                //if ($cancel_res)
//                    $transaction->fanex_status = 'pending'; // it's already on pending condition
                $transaction->upt_status = 'failed'; //?
                $transaction->update();
                return json_encode(array('status' => false, 'msg' => 'درخواست ارسال با خطا روبرو شد')); //upt request has problem.
            }
            return json_encode(array('status' => true, 'msg' => 'انتقال موفقیت آمیز بود')); //The transfer was successfully settled.

        } elseif ($request->rejected) {
            $transaction->fanex_status = 'rejected';
            $result = $this->chargeUserWallet($transaction->user, $transaction->payment_amount);
            //charge the user wallet
            if (!$result->hasError) {
                $transaction->update();
                return json_encode(array('status' => false, 'msg' => 'عملیات برگشت به حساب')); //The transfer was successfully settled.
            } else
                return json_encode(array('status' => false, 'msg' => 'خطا در عملیات'));
        }

    }

    public function excel()
    {
        // Initialize the array which will be passed into the Excel
        // generator.
//        if ($request['order'] != null) {
//            $order = $request['order'];
//            $option = $request ['option'];
//        } else {
        $order = 'transactions.payment_date';
        $option = 'DESC';
//        }

        $extraInfo['order'] = $order;
        $extraInfo['option'] = $option;

        $transactions = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->filterBank('successful')
            ->filterFanex('pending')
            ->per('daily')
            ->orderBy($order, $option)
            ->get();
        $paymentsArray = [];

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['reference_number', 'bank_status', 'fanex_status', 'upt_status', 'currency', 'rate',
            'premium_amount', 'payment_type', 'payment_date', 'country', 'upt_reference', 'updated_at', 'sender_firstname', 'sender_lastname'
            , 'identity_number', 'tel_number', 'beneficiary_firstname', 'beneficiary_lastname', 'account_number', 'bank_name', 'branch_address', 'iban', 'swift'];
        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        $this->excel_export($transactions, $paymentsArray, 'today_pending_transaction', 'Exchanger', 'FANEx');

    }
}
