<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Transaction extends Model
{
    protected $table = 'transactions';

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
            ->select("transactions.*", "users.firstname", "users.lastname");
    }

    public function scopeJoinBeneficiaries($query)
    {
        return $query->join('beneficiaries', 'transactions.beneficiary_id', '=', 'beneficiaries.id')
            ->select("transactions.*", "beneficiaries.firstname", "beneficiaries.lastname");
    }

    public function scopeSelectBoth($query)
    {
        $query->select("transactions.*", "users.firstname", "users.lastname" ,"beneficiaries.firstname as f", "beneficiaries.lastname as l");
    }

    public function scopePer($query, $per)
    {
        switch ($per) {
            case 'daily':
                $query->where(DB::raw('DATE_FORMAT(payment_date, "%Y-%m-%d")'), '=', DB::raw('CURDATE()'));
//                return $query->whereRaw("to_date(to_char(sysdate,'dd/mm/yyyy'),'dd/mm/yyyy') = to_date(to_char(payment_date, 'dd/mm/yyyy'),'dd/mm/yyyy')");
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
}
