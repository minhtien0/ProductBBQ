<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_combos', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade'); // Khóa ngoại liên kết với bảng foods
            $table->foreignId('combo_id')->constrained('food_combos')->onDelete('cascade'); // Khóa ngoại liên kết với bảng food_combos
            $table->timestamps(); // Cột created_at và updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_combos'); // Xóa bảng nếu rollback
    }
}