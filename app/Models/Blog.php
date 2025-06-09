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
        'id_staff',
        'slug',
    ];

    // Định dạng kiểu dữ liệu cho cột ngay_dang
    protected $casts = [
        'ngay_dang' => 'datetime',
    ];

     public function staff()
    {
        return $this->belongsTo(Staff::class, 'id_nv');
    }

     public function rates()
    {
        return $this->hasMany(Rate::class, 'blog_id');
    }
}