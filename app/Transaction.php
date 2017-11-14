<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $table = 'transactions';

    protected $hidden = ['id','user_id','beneficiary_id','backlog_id','ttl','vat','payment_amount','created_at']; //todo : check with parham for available fields in exchanger pdf

    protected $dates = [
        'payment_date',
        'ttl'
    ];

    protected $casts = [
        'premium_amount' => 'float'
    ];

    public function scopeFindByBillNumber($query, $billNumber)
    {
        return $query->where('uri', $billNumber);
    }

    public function scopeHasttl($query)
    {
        return $query->where('ttl', '>', Carbon::now());
    }

//    public function user()
//    {
//        return $this->belongsTo('App\User');
//    }

    public function user()
    {
        return $this->belongsTo('App\Client');
    }

    public function beneficiary()
    {
        return $this->belongsTo('App\Beneficiary');
    }

    public function backlog()
    {
        return $this->belongsTo('App\Backlog');
    }

    public function scopeFilterBank($query, $filter)
    {
        return $query->where('bank_status', $filter);
    }

    public function scopeFilterFanex($query, $filter)
    {
        return $query->where('fanex_status', $filter);
    }

    public function scopeFilterUpt($query, $filter)
    {
        return $query->where('upt_status', $filter);
    }

    public function scopeJoinUsers($query)
    {
        return $query->join('users', 'transactions.user_id', '=', 'users.id')
            ->select("transactions.*", "users.firstname", "users.lastname", "users.identity_number", "users.mobile");
    }

    public function scopeJoinBeneficiaries($query)
    {
        return $query->join('beneficiaries', 'transactions.beneficiary_id', '=', 'beneficiaries.id')
            ->select("transactions.*", "beneficiaries.firstname", "beneficiaries.lastname","beneficiaries.account_number","bank_name","branch_address"
                ,"iban_code","swift_code");
    }

    public function scopeSelectBoth($query)
    {
        return $query->select("transactions.*", "users.firstname as sender_fname", "users.lastname as sender_lname", "users.identity_number as sender_identity_number"
            , "users.mobile as sender_mobile"
            ,"beneficiaries.firstname as bnf_fname", "beneficiaries.lastname as bnf_lname","beneficiaries.account_number","bank_name","branch_address"
            ,"iban_code","swift_code");
    }

    public function scopePer($query, $per)
    {
        switch ($per) {
            case 'daily':
//                $query->where(DB::raw('DATE_FORMAT(payment_date, "%Y-%m-%d")'), '=', DB::raw('CURDATE()'));
//                return $query->whereRaw("to_date(to_char(sysdate,'dd/mm/yyyy'),'dd/mm/yyyy') = to_date(to_char(payment_date, 'dd/mm/yyyy'),'dd/mm/yyyy')");
                return $query->whereRaw("TRUNC(sysdate) = TRUNC(payment_date)");
                break;

            case 'weekly':
//                return $query->whereBetween('payment_date', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 1 WEEK)'));
                return $query->whereRaw("payment_date between next_day(TRUNC(SYSDATE) - 7, 'sat') and trunc(sysdate)");
                break;

            case 'monthly':
                return $query->whereRaw("payment_date between trunc(sysdate, 'mm') AND SYSDATE");
                break;
            default:
                return $query;
                break;
        }
    }

    public function scopeArraySelect($query , $inputArray)
    {
        $query = $query->select($inputArray[0]);
        unset($inputArray[0]);
        foreach ($inputArray as $element) {
            $query = $query->addSelect($element);
        }
        return $query;
    }

//    public function scopeDailyFactor($query)
//    {
//        return $query
//            ->join('boshra.video', 'user_buy.video_id', '=', 'video.id')
//            ->join('billing.users', 'video.producer_id', '=', 'users.id')
//            ->select(DB::raw(" SUM( user_buy.cost ) as sale_cost,users.id as producer_id,  users.first_name , users.last_name"))
//            ->where(DB::raw('DATE_FORMAT(purchase_date, "%Y-%m-%d")'), '=', DB::raw('subdate(CURDATE(), 1)'))
//            ->groupBy('producer_id');
//
//    }

    public function scopeDatePicker($query, $fromDate, $toDate)
    {

        return $query->whereRaw(('payment_date BETWEEN :fromDate AND :toDate'
        ), array(
                'fromDate' => $fromDate,
                'toDate' => $toDate,
            )
        );
    }

}
