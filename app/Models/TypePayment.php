<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypePayment extends Model
{
    //
    protected $table = 'typepayments';
    protected $fillable = [
        'name',
        'created_at',
    ];
    public $timestamps = false;
}
