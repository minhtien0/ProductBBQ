<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'order_details';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'time',
        'status',
    ];

    // Mối quan hệ với bảng Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Mối quan hệ với bảng Food
    public function food()
    {
        return $this->belongsTo(Food::class, 'product_id');
    }
}