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
        'id_user',
        'address',
        'id_staff',
        'totalprice',
        'voucher',
        'totalbill',
        'statusorder',
        'typepayment',
        'status',
        'note',
        'type',
        'created_at',
        'updated_at',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
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