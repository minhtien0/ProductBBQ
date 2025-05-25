<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    //
    protected $table = 'branchs';
    protected $fillable = [
        'name',
        'address',
    ];

     public function staffs()
    {
        return $this->hasMany(Staff::class, 'branch_id');
    }
}
