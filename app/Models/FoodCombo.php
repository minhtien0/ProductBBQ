<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FoodCombo extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'food_combos';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'codecombo',
        'price',
        'note',
        'create_at',
        'image',
    ];

    // Định dạng kiểu dữ liệu cho cột create_at
    protected $casts = [
        'create_at' => 'datetime',
        'price' => 'decimal:2',
    ];

     public function foods()
    {
        return $this->belongsToMany(Food::class, 'detail_combos', 'combo_id', 'food_id');
    }

     public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_combos', 'combo_id', 'order_id');
    }
}