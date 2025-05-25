<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    // Tên bảng liên kết với model
    protected $table = 'menus';

    // Các cột có thể được gán giá trị (mass assignment)
    protected $fillable = [
        'name',
        'notes',
        'create_at',
    ];

    // Định dạng kiểu dữ liệu cho cột create_at
    protected $casts = [
        'create_at' => 'datetime',
    ];

      public function foods()
    {
        return $this->hasMany(Food::class, 'type');
    }
}