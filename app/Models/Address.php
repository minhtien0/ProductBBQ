<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'addresses';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'name',
        'sdt',
        'house_number',
        'ward',
        'district',
        'city',
        'default',
        'note',
        'user_id',
    ];

    // Định dạng kiểu dữ liệu
    protected $casts = [
        'default' => 'boolean',
    ];

    // Mối quan hệ với bảng User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}