<?php

namespace App\Http\Controllers;

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

        $payed_transactions = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->filterBank('successful')->filterFanex('pending')->orderBy('transactions.id', 'DESC')->paginate(10); //todo : for test try it with 'canceled' and 'rejected'
        return view('pages.transactions', compact('payed_transactions', 'top_widget'));
    }

    public function search(Request $request)
    {
        preg_match_all('/(?:(name|phone|account):)([^: ]+(?:\s+[^: ]+\b(?!:))*)/xi', $request->keyword, $matches, PREG_SET_ORDER);

        $result = array();
//        dd($matches);
        foreach ($matches as $match) {
//            dd($match[1]);
//            $result[$match[1]] = ($result[$match[1]]) ? $result[$match[1]] . ' ' . $match[2] : $match[2];

            if (isset($result[$match[1]])) {
                $result[$match[1]] = $result[$match[1]] . ' ' . $match[2];
            } else
                $result[$match[1]] = $match[2];
        }
//        $sql = "select * from transactions where bank_status = 'successful'";
        if($result) {
            $transactions = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->filterBank('successful')
//            ->filterFanex('pending')
                ->where(function ($query) use ($result) {
                    foreach ($result as $k => $v) {
                        switch (strtolower($k)) {
                            case 'name':
                                $exploded = explode(' ', $v);
                                $name = array_shift($exploded);
                                if (preg_match("/^[a-zA-Z\s]+$/", $name)) {
                                    $query->whereRaw("regexp_like(beneficiaries.firstname, '$name', 'i')")
                                    ->orWhereRaw("regexp_like(users.firstname, '$name', 'i')");
                                    if (count($exploded) > 0) {
                                        foreach ($exploded as $name) {
                                            if (preg_match("/^[a-zA-Z\s]+$/", $name)) {
                                                $query->where(function ($query) use ($name) {
                                                    $query->orWhereRaw("regexp_like(beneficiaries.firstname, '$name', 'i')")
                                                    ->orWhereRaw("regexp_like(users.firstname, '$name', 'i')");
                                                });
                                            }
                                        }
                                    }
                                }

                            case 'phone':
                                $exploded = explode(' ', $v);
                                $phone = array_shift($exploded);
                                if (ctype_digit($phone)) {
                                    $query->whereRaw("regexp_like(beneficiaries.tel, '$name', 'i')");
                                    if (count($exploded) > 0) {
                                        foreach ($exploded as $phone) {
                                            if (ctype_digit($phone)) {
                                                $query->where(function ($query) use ($phone) {
                                                    $query->orWhereRaw("regexp_like(beneficiaries.tel, '$phone', 'i')");
                                                });
                                            }
                                        }
                                    }
                                }
                                break;
                            case 'account':
                                $exploded = explode(' ', $v);
                                $account = array_shift($exploded);
                                if (ctype_digit($account)) {
                                    $query->whereRaw("regexp_like(beneficiaries.account_number, '$account', 'i')");
                                    if (count($exploded) > 0) {
                                        foreach ($exploded as $account) {
                                            if (ctype_digit($account)) {
                                                $query->where(function ($query) use ($account) {
                                                    $query->orWhereRaw("regexp_like(beneficiaries.account_number, '$account', 'i')");
                                                });
                                            }
                                        }
                                    }
                                }
                                break;
                            default:
                                $query->where('id',0);
                                break;
                        }
                    }

//                $query->where('transactions.uri', 'like', "%$keyword%")
//                    ->orWhereRaw("regexp_like(beneficiaries.firstname, '$keyword', 'i')")
//                    ->orWhereRaw("regexp_like(beneficiaries.lastname, '$keyword', 'i')");
////                        ->orWhere('transactions.premium_amount', 'like', "%$keyword%")
////                        ->orWhere('beneficiaries.firstname', 'like', "%$keyword%")
////                        ->orWhere('beneficiaries.lastname', 'like', "%$keyword%");
//            })->orderby("transactions.id", "desc")->paginate(10);
////            ->orderBy('transactions.id', 'DESC')->paginate(10);

            })->paginate(10);

        }
        else {
            $transactions = Transaction::where('id',0)->paginate(10); // :D
        }

        if ($request->ajax())
            return response()->json(view('partials.search-transactions', compact('transactions'))->render());
        else {
            $top_widget = array();
            $top_widget['transactions_count'] = Transaction::filterBank('successful')->per('daily')->count();
            $top_widget['transactions_sum'] = Transaction::filterBank('successful')->per('daily')->sum('payment_amount');
            return view('pages.transactions', compact('top_widget', 'transactions'));
        }
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
    public function show(Request $request, $transaction)
    {
//        $transaction = $transaction->toArray();
        $transaction = Transaction::joinUsers()->joinBeneficiaries()->selectBoth()->where('transactions.id', $transaction)->first();
        if ($request->ajax())
            return response()->json(view('partials.singleTrans', compact('transaction'))->render());
//            return view('partials.modalTransShow', compact('transaction'));
//        return view('identifier', compact('transaction'));
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

    public function excel(Request $request)
    {
        $payments = Transaction::join('users', 'transactions.user_id', '=', 'users.id')
            ->select(
                'transactions.id as tid',
                DB::raw("(users.firstname || ' ' || users.lastname) as name"),
                'users.email as mail',
                DB::raw("(transactions.premium_amount || ' ' || transactions.currency) as payment"),
                'transactions.payment_amount as payable',
                'transactions.payment_date')
            ->where("users.id", '=', 3)->get();

        // Initialize the array which will be passed into the Excel
        // generator.
        $paymentsArray = [];

        // Define the Excel spreadsheet headers
        $paymentsArray[] = ['id', 'customer', 'email', 'payment', 'payable', 'created_at'];

        // Convert each member of the returned collection into an array,
        // and append it to the payments array.
        foreach ($payments as $payment) {
            $paymentsArray[] = $payment->toArray();
        }

        // Generate and return the spreadsheet
        $excel = Excel::create('payments', function ($excel) use ($paymentsArray) {

            // Set the spreadsheet title, creator, and description
            $excel->setTitle('Payments');
            $excel->setCreator('Exchanger')->setCompany('FANEx');
            $excel->setDescription('payments file');

            // Build the spreadsheet, passing in the payments array
            $excel->sheet('sheet1', function ($sheet) use ($paymentsArray) {
                $sheet->fromArray($paymentsArray, null, 'A1', false, false);
            });

        })->export('xls');

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
