<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Gallery extends Model
{

    protected $fillable = [
        'user_id',
        'image',
        'video',
        'description',

    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function scopeByUser($query)
    {
        $user = Auth::user();
        $query->where('user_id','=', $user->id);
    }
}
