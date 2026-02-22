<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

use Laravel\Sanctum\HasApiTokens;

class usermodel extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'users';
    protected $fillable = ['name','email','number','password','Gender'];
    protected $hidden = ['password', 'remember_token'];
}
