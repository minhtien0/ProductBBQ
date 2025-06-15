<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailCombo extends Model
{
    use HasFactory;

    protected $table = 'detail_combos'; // Bảng tương ứng

    protected $fillable = [
        'food_id',
        'combo_id',
    ];

    // Quan hệ: Một DetailCombo thuộc về một món ăn (Food)
    public function food()
    {
        return $this->belongsTo(Food::class);
    }

    // Quan hệ: Một DetailCombo thuộc về một combo
    public function combo()
    {
        return $this->belongsTo(FoodCombo::class, 'combo_id');
    }
}
