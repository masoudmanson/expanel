<?php

namespace App\Http\Controllers;

use App\Traits\PlatformTrait;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Excel;

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
        $top_widget = array();
        $top_widget['transactions_count'] = Transaction::filterBank('successful')->per('daily')->count();
        $top_widget['transactions_sum'] = Transaction::filterBank('successful')->per('daily')->sum('payment_amount');

        $payed_transactions = Transaction::filterBank('canceled')->filterFanex('rejected')->orderBy('id','DESC')->paginate(10); //todo : for test try it with 'canceled' and 'rejected'
        dd($payed_transactions);

        return view('pages.transactions', compact('payed_transactions','top_widget'));
    }

    public function search(Request $request , $data)
    {
//        dd($data);
        $regex = '/((name)|(phone)|(account))\s*\:\s*\w*\s*\w*\;/';
//        preg_match($regex, $data, $matches);
        preg_match_all($regex, $data, $matches, PREG_SET_ORDER, 0);
        dd($matches);
//        print_r($matches);
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

    public function excel(Request $request)
    {
        $payments = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
            ->select(
                'transactions.id',
                DB::raw("(users.firstname || ' ' || users.lastname) as name"),
                'users.email',
                DB::raw("(transactions.premium_amount || ' ' || transactions.currency) as payment"),
                'transactions.payment_amount',
                'transactions.payment_date')
            ->where("users.id" , '=' , 3)->get();

//dd('salaaaaam');
        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = [];

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['id', 'customer','email','payment','payable','created_at'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        $excel = Excel::create('payments', function($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Payments');
            $excel->setCreator('Laravel')->setCompany('WJ Gilmore, LLC');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->export('xls');

        dd($excel);
    }
    //whereRaw("to_date(to_char(sysdate,'dd/mm/yyyy'),'dd/mm/yyyy') = to_date(to_char(payment_date, 'dd/mm/yyyy'),'dd/mm/yyyy')");

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
