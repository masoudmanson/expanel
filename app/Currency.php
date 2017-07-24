<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    protected $table = 'currencies';

    public function rates()
    {
        return $this->hasMany('App\Rate','currency_id');
//            ->orderBy('id', 'DESC');
    }
}
