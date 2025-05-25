<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegisterJob extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'register_jobs';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'staff_id',
        'job_id',
        'register_time',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'register_time' => 'datetime',
    ];

    // Mối quan hệ với bảng Staff
    public function staff()
    {
        return $this->belongsTo(Staff::class, 'staff_id');
    }

    // Mối quan hệ với bảng Job
    public function job()
    {
        return $this->belongsTo(Job::class, 'job_id');
    }
}