<?php

namespace App;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

use Illuminate\Database\Eloquent\Model;

class User extends Authenticatable
{
    use HasApiTokens;

    protected $fillable = [
        'name',  'email', 'password'
    ];
    
    protected $hidden = [
        'password', 'remember_token',
    ];
}
