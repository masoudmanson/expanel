<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    protected $table = 'rates';

    protected $fillable = ['exchanger_user_id', 'currency_id' , 'rate', 'ip'];

    public function exchanger()
    {
        return $this->belongsTo('App\Exchanger','exchanger_user_id');
    }
    public function currencyExchange()
    {
        return $this->belongsTo('App\CurrencyExchange','exchanger_id');
    }

    public function currencies()
    {
        return $this->belongsTo('App\Currency','currency_id');
    }

    public function scopeCurrency($query, $currency)
    {
        $curr = Currency::getByType($currency);
        return $query->where('rates.currency_id', $curr->id);
    }

    public function scopeLast($query)
    {
        return $query->orderBy('rates.id', 'DESC')->first();
    }

}
