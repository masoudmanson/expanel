<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

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
        return $query->where('uri', $billNumber); //unique ref. number
    }

    public function scopeHasttl($query)
    {
        return $query->where('ttl', '>' , Carbon::now() );
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

    public function scopeFilterBank($query,$filter)
    {
        return $query->where('bank_status',$filter);
    }
    public function scopeFilterFanex($query,$filter)
    {
        return $query->where('fanex_status',$filter);
    }
    public function scopeFilterUpt($query,$filter)
    {
        return $query->where('upt_status',$filter);
    }

    public function scopeOrder($query)
    {
        $query->where('premium_amount','>', 1000)->orderBy('premium_amount'); // todo : why not working?! :|
    }

}
