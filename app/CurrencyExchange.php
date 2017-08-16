<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CurrencyExchange extends Model
{
    protected $fillable = [
        'exchanger_name', 'username', 'email', 'password',
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
}
