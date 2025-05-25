<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'invoices';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'table_id',
        'staff_id',
        'order_id',
        'totalprice',
        'voucher',
        'total_bill',
        'typepayment_id',
        'time',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'totalprice' => 'decimal:2',
        'total_bill' => 'decimal:2',
        'time' => 'datetime',
    ];

    // Mối quan hệ với bảng Table
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }

    // Mối quan hệ với bảng Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    // Mối quan hệ với bảng Order
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    // Mối quan hệ với bảng Typepayment
    public function typepayment()
    {
        return $this->belongsTo(Typepayment::class, 'typepayment_id');
    }
}