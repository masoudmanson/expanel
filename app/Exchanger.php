<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//class Exchanger extends Model
class Exchanger extends Authenticatable
{
    use Notifiable;

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

    protected $table = 'exchanger_users';

    public function scopeFindByUserId($query,$userId)
    {
        return $query->where('userId', $userId);
    }

    public function rates()
    {
        return $this->hasMany('App\Rate','exchanger_user_id')->orderBy('id', 'DESC');
    }

    public function currencyExchange() {
        return $this->belongsTo('App\CurrencyExchange','exchanger_id');
    }

//    public function currencies()
//    {
//        return $this->hasMany('App\Currency');
////            ->orderBy('id', 'DESC');
//    }

}
