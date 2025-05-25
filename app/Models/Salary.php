<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'salaries';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'staff_id',
        'datetime',
        'basic_salary',
        'ot_salary',
        'tip',
        'bonus',
        'status',
        'deduction_fee',
        'note',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'datetime' => 'datetime',
        'basic_salary' => 'decimal:2',
        'ot_salary' => 'decimal:2',
        'tip' => 'decimal:2',
        'bonus' => 'decimal:2',
        'deduction_fee' => 'decimal:2',
    ];

    // Mối quan hệ với bảng Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }
}