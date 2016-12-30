<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
        'mobile',
        'used_id',
        'api_token',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'api_token'
    ];

    public function post()
    {
        return $this->hasMany('App\Post');
    }

    public function scopeIsSuperUser($query)
    {
        $query->where('type_id', '=', 2);
    }

    public function scopeIsSpecialUser($query)
    {
        $query->where('type_id', '=', 1);
    }
    
    public function scopeIsSimpleUser($query)
    {
        $query->where('type_id', '=', 0);
    }

}
