<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'orders';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'code',
        'table_id',
        'create_at',
        'status',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'create_at' => 'datetime',
    ];

    // Mối quan hệ với bảng Table
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

     public function combos()
    {
        return $this->belongsToMany(FoodCombo::class, 'order_combos', 'order_id', 'combo_id');
    }
    
     public function details()
    {
        return $this->hasMany(OrderDetail::class, 'order_id');
    }
}