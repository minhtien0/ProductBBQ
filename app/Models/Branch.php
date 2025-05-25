<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'branchs';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'name',
        'address',
    ];

    // Mối quan hệ với bảng Staff
    public function staffs()
    {
        return $this->hasMany(Staff::class, 'branch_id');
    }
}