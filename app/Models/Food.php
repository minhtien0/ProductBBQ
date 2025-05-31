<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Food extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'foods';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'name',
        'type',
        'description',
        'image',
        'price',
        'status',
        'slug',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'price' => 'decimal:2',
    ];

    // Mối quan hệ với bảng Menu
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'type');
    }

     // Mối quan hệ nhiều-nhiều với bảng FoodCombo
    public function combos()
    {
        return $this->belongsToMany(FoodCombo::class, 'detail_combos', 'food_id', 'combo_id');
    }

     // Mối quan hệ 1-nhiều với bảng OrderDetail
     public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class, 'product_id');
    }

     public function favorites()
    {
        return $this->hasMany(Favorite::class, 'food_id');
    }
}