<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::parse($date);
    }

    public function scopePublished($query)
    {
        $query->where('published_at','<=',Carbon::now());
    }

    public function scopeByUser($query)
    {
        $user = Auth::user();
        $query->where('user_id','=', $user->id);
    }
}
