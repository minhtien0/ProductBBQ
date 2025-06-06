<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'companies';
    protected $fillable = [
        'name',
        'address',
        'sdt',
        'email',
        'timeopen',
        'timeclose',
        'facebook',
        'telegram',
        'instagram',
    ];
}
