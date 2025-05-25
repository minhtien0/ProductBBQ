<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'jobs';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'name',
        'time_start',
        'time_end',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'time_start' => 'datetime',
        'time_end' => 'datetime',
    ];

    public function staffs()
    {
        return $this->belongsToMany(Staff::class, 'job_staff', 'job_id', 'staff_id');
    }

    public function registerJobs()
    {
        return $this->hasMany(RegisterJob::class, 'job_id');
    }

    // Mối quan hệ với bảng Timekeeping
    public function timekeepings()
    {
        return $this->hasMany(Timekeeping::class, 'job_id');
    }

}