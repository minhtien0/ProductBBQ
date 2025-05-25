<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'staffs';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'fullname',
        'code_nv',
        'date_of_birth',
        'gender',
        'SDT',
        'CCCD',
        'status',
        'address',
        'email',
        'time_work',
        'branch_id',
        'type',
        'avata',
        'STK',
        'bank',
        'hourly_wage',
        'Basic_Salary',
        'role',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'date_of_birth' => 'date',
        'time_work' => 'datetime',
        'hourly_wage' => 'decimal:2',
        'Basic_Salary' => 'decimal:2',
    ];

    // Mối quan hệ với bảng Branch
    public function branch()
    {
        return $this->belongsTo(Branch::class, 'branch_id');
    }

    public function registerJobs()
    {
        return $this->hasMany(RegisterJob::class, 'staff_id');
    }

     // Mối quan hệ với bảng Timekeeping
    public function timekeepings()
    {
        return $this->hasMany(Timekeeping::class, 'staff_id');
    }

    // Mối quan hệ với bảng Overtime
    public function overtimes()
    {
        return $this->hasMany(Overtime::class, 'staff_id');
    }

    // Mối quan hệ với bảng Tip
    public function tips()
    {
        return $this->hasMany(Tip::class, 'staff_id');
    }

    // Mối quan hệ với bảng Off
    public function offs()
    {
        return $this->hasMany(Off::class, 'staff_id');
    }

    // Mối quan hệ với bảng Salary
    public function salaries()
    {
        return $this->hasMany(Salary::class, 'staff_id');
    }

    // Mối quan hệ với bảng Invoice
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'staff_id');
    }
}