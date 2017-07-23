<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

//class User extends Authenticatable
class User extends Exchanger
{
    use Notifiable;
}
