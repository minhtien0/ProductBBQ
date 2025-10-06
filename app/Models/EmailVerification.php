<?php

// app/Models/EmailVerification.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailVerification extends Model
{
    protected $table = 'email_verifications';
    public $timestamps = true;
    protected $fillable = [
        'user', 'password', 'sdt', 'email', 'fullname', 'email_verify_token', 'token_created_at',
    ];
}

