<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'tables';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'number',
        'status',
    ];

    public function bookings()
    {
        return $this->hasMany(BookingTable::class, 'table_id');
    }

     public function orders()
    {
        return $this->hasMany(Order::class, 'table_id');
    }
}