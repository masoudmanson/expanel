<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyExchange extends Model
{
    protected $fillable = [
        'exchanger_name',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $table = 'exchangers';

    public function exchanger()
    {
        return $this->hasMany('App\Exchanger')->orderBy('id', 'DESC');
    }

    public function identifier()
    {
        return $this->hasOne('App\Identifier', 'exchanger_id');
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

    public function scopeRates($query)
    {
        $exchanger = $this->id;
        return $query->join('exchanger_users', 'exchanger_users.exchanger_id', '=', "exchangers.id")
            ->where('exchangers.id', $exchanger)
            ->join('rates', 'rates.exchanger_user_id', '=', 'exchanger_users.id')
            ->select("rates.*");
    }

//    public function rates()
//    {
//        return $this->hasManyThrough(
//            'App\Rate',
//            'App\Exchanger',
//            'exchanger_id',
//            'exchanger_user_id');
//    }
}
