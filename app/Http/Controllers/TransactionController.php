<?php

namespace App\Http\Controllers;

use App\Traits\PlatformTrait;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    use PlatformTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payed_transactions = Transaction::filterBank('successful')->filterFanex('pending')->get(); //todo : for test try it with 'canceled' and 'rejected'

        return view('pages.transactions', compact('payed_transactions'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param Request $request
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Transaction $transaction)
    {
        $identifier = $transaction->toArray();
        if ($request->ajax())
            return view('partials.identifier-form', compact('identifier'));
        return view('identifier', compact('identifier'));
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
     * @param Transaction $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {

        if ($request->accepted) {
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
                }
            } else {
                //if ($cancel_res)
//                    $transaction->fanex_status = 'pending'; // it's already on pending condition
                $transaction->upt_status = 'failed'; //?
                $transaction->update();
                // return ?
            }

        } elseif ($request->rejected) {
            $transaction->fanex_status = 'rejected';
            $result = $this->chargeUserWallet($transaction->user, $transaction->payment_amount);
            //charge the user wallet
            if (!$result->hasError)
                $transaction->update();
            else
                dd(':D nashod'); // return ?
        }

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
