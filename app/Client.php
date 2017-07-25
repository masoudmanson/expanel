<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'api_token','firstname', 'lastname', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = [
        'date_of_birth'
    ];

    protected $table = 'users';

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
