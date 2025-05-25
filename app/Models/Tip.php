<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tip extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'tips';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'staff_id',
        'tip_amount',
        'time',
        'note',
        'create_at',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'tip_amount' => 'decimal:2',
        'time' => 'datetime',
        'create_at' => 'datetime',
    ];

    // Mối quan hệ với bảng Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}