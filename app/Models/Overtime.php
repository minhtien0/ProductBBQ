<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Overtime extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'overtimes';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'staff_id',
        'time',
        'quantity',
        'note',
        'status',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'time' => 'datetime',
        'quantity' => 'decimal:2',
    ];

    // Mối quan hệ với bảng Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}