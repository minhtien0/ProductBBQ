<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'carts';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'food_id',
        'user_id',
        'quantity',
        'type',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'quantity' => 'integer',
    ];

    // Mối quan hệ với bảng Food
    public function food()
    {
        return $this->belongsTo(Food::class, 'food_id');
    }

    // Mối quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}