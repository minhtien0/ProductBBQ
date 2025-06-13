<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'staffs';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'fullname',
        'code_nv',
        'date_of_birth',
        'gender',
        'SDT',
        'CCCD',
        'status',
        'address',
        'email',
        'time_work',
        'type',
        'avata',
        'STK',
        'bank',
        'role',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'date_of_birth' => 'date',
        'time_work' => 'datetime',
    ];

    // Mối quan hệ với bảng Invoice
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'staff_id');
    }
}