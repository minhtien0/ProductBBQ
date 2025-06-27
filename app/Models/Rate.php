<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'rates';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'user_id',
        'content',
        'rate',
        'food_id',
        'blog_id',
        'time',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'time' => 'datetime',
        'rate' => 'integer',
    ];

    // Mối quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Mối quan hệ với bảng Food
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    // Mối quan hệ với bảng Blog
    public function blog()
    {
        return $this->belongsTo(Blog::class, 'blog_id');
    }

    public function images()
    {
        return $this->hasMany(Image::class, 'id_rate'); 
    }
}