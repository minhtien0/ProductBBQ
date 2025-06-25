<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BookingTable extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'booking_tables';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'nameuser',
        'sdt',
        'quantitypeople',
        'time_booking',
        'table_id',
        'notes',
        'time_order',
        'status',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'time_booking' => 'datetime',
        'time_order' => 'datetime',
    ];

    // Mối quan hệ với bảng Table
    public function table()
    {
        return $this->belongsTo(Table::class, 'table_id');
    }
}