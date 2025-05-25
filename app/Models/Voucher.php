<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'vouchers';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'code',
        'value',
        'time_start',
        'time_end',
        'quantity',
        'status',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'value' => 'decimal:2',
        'time_start' => 'datetime',
        'time_end' => 'datetime',
    ];
}