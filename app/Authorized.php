<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Authorized extends Model
{
    protected $table = 'authorized';

    protected $hidden = ['identifier_id'];

    protected $fillable = [
        'firstname',
        'lastname',
        'identity_number',
        'mobile'
    ];
}
