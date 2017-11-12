<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Identifier extends Model
{
    protected $table = 'identifiers';

    protected $hidden = [
        'created_at',
        'updated_at',
        'status',
        'name'
    ];

    public function scopeAvailable($query)
    {
        return $query->where('status', '=', '1');
    }

    public function currencyExchange()
    {
        return $this->belongsTo('App\CurrencyExchange','exchanger_id');
    }
}
