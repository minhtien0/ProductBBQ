<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favorite extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'favorites';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'user_id',
        'food_id',
        'create_at',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'create_at' => 'datetime',
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
}