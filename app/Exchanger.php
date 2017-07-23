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

    protected $table = 'exchangers';

    public function scopeFindByUserId($query,$userId)
    {
        return $query->where('userId', $userId);
    }

    public function beneficiary()
    {
        return $this->hasMany('App\Beneficiary');
    }

    public function transaction()
    {
        return $this->hasMany('App\Transaction')->orderBy('id', 'DESC');
    }

}
