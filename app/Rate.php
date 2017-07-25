<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';

    protected $fillable = ['exchanger_id', 'currency_id' , 'rate', 'ip'];

    public function exchanger()
    {
        return $this->belongsTo('App\Exchanger','exchanger_id');
    }

    public function currencies()
    {
        return $this->belongsTo('App\Currency','currency_id');
    }

    public function scopeCurrency($query, $currency)
    {
        return $query->where('currency_id', $currency);
    }

    public function scopeLast($query)
    {
        return $query->orderBy('id', 'DESC')->first();
    }

}
