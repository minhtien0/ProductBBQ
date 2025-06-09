<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Cột id (khóa chính, tự động tăng)
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade'); // Khóa ngoại liên kết với bảng foods
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại liên kết với bảng users
            $table->unsignedInteger('quantity')->default(1); // Cột quantity (số lượng, mặc định là 1)
            $table->string('type'); // Cột type (kiểu, ví dụ: normal, combo)
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
        Schema::dropIfExists('carts'); // Xóa bảng nếu rollback
    }
}