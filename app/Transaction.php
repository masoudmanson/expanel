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

    public function user()
    {
        return $this->belongsTo('App\User');
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

    public function scopeTopTen($query, $per)
    {
        switch ($per) {
            case 'daily':
                $query->where(DB::raw('DATE_FORMAT(payment_date, "%Y-%m-%d")'), '=', DB::raw('CURDATE()'))
                    ->orderBy('premium_amount', 'DESC')->limit(10);
                break;

            case 'weekly':
                $query->where('payment_date', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 1 WEEK)'))
                    ->orderBy('premium_amount', 'DESC')->limit(10);
                break;

            case 'monthly':
                $query->where('payment_date', '>', DB::raw('DATE_SUB(NOW(), INTERVAL 1 MONTH)'))
                    ->orderBy('premium_amount', 'DESC')->limit(10);
                break;
            default:
                break;
        }
    }
}
