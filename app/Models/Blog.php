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
        'image',
        'id_staff',
        'slug',
        'created_at',
        'updated_at',
    ];

    // Định dạng kiểu dữ liệu cho cột ngay_dang
    protected $casts = [
        'created_at' => 'datetime',
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