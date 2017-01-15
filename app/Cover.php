<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Cover extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'image',
        'page',
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

    public function scopeById($query,$id)
    {
        $query->where('user_id','=', $id);
    }

    public function scopeGallery($query)
    {
        $query->where('page','=','gallery');
    }
    public function scopePost($query)
    {
        $query->where('page','=','post');
    }
}
