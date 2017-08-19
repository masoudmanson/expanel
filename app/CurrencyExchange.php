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
        return $this->hasOne('App\Identifier','exchanger_id');
    }

    public function rates()
    {
        return $this->hasManyThrough('App\Rate', 'App\Exchanger',
            'exchanger_id', 'exchanger_user_id', 'id');
    }
}
