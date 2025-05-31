<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $fillable = [
        'user',
        'password',
        'sdt',
        'email',
        'fullname',
        'birthday',
        'gender',
        'avatar',
        'role',
        'email_verify_token',
        'token_created_at',
    ];
    protected $hidden = [
        'password',
        'email_verify_token',
    ];

    protected $casts = [
        'birthday' => 'date',
        'email_verified_at'=> 'datetime',
        'token_created_at' => 'datetime',
    ];

    public function addresses()
    {
        return $this->hasMany(Address::class, 'user_id');
    }

    public function favorites() 
    {
        return $this->hasMany(Favorite::class, 'user_id');
    }
}