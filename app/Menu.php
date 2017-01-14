<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{

    protected $table = 'menu';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeByUser($query)
    {
        $user = Auth::user();
        $query->where('user_id','=', $user->id);
    }

    public function scopeById($query,$id)
    {
        $query->where('user_id','=', $id);
    }
}
