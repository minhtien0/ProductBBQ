<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_combos', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Khóa ngoại liên kết với bảng orders
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
        Schema::dropIfExists('order_combos'); // Xóa bảng nếu rollback
    }
}