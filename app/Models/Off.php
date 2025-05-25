<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Off extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'offs';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'staff_id',
        'time',
        'type',
        'reason',
        'note',
        'sending_time',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'time' => 'datetime',
        'sending_time' => 'datetime',
    ];

    // Mối quan hệ với bảng Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}