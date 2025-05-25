<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'blog';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'title',
        'type',
        'content',
        'time',
        'image',
        'slug',
    ];

    // Định dạng kiểu dữ liệu cho cột ngay_dang
    protected $casts = [
        'ngay_dang' => 'datetime',
    ];
}