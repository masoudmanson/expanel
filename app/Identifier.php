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
//
//    const NAME = 'fanapium';
////    const FIELD_1 = 'international_code';
////    const FIELD_2 = 'mobile';
//    const STATUS = TRUE;
//
//    protected $attributes = [
//        'name' => self::NAME,
////        'field_1' => self::FIELD_1,
////        'field_2' => self::FIELD_2,
//        'status' => self::STATUS,
//    ];

    public function scopeAvailable($query)
    {
        return $query->where('status', '=', '1');
    }

    public function currencyExchange()
    {
        return $this->belongsTo('App\CurrencyExchange','exchanger_id');
    }
}
