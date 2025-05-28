<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Help extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'helps';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'title',
        'purpose',
        'question',
        'sdt',
        'email',
        'time',
        'content',
        'status',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'time' => 'datetime',
    ];
}