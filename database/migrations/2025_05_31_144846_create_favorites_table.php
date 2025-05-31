<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFavoritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id(); // Cột id (khóa chính, tự động tăng)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại liên kết với bảng users
            $table->foreignId('food_id')->constrained('foods')->onDelete('cascade'); // Khóa ngoại liên kết với bảng foods
            $table->dateTime('create_at'); // Cột create_at (thời gian tạo, datetime)
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
        Schema::dropIfExists('favorites'); // Xóa bảng nếu rollback
    }
}