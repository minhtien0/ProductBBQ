<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rates', function (Blueprint $table) {
            $table->id(); // Cột id (khóa chính, tự động tăng)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại liên kết với bảng users
            $table->text('content')->nullable(); // Cột content (nội dung đánh giá, text, có thể null)
            $table->unsignedTinyInteger('rate'); // Cột rate (điểm đánh giá, ví dụ 1-5)
            $table->integer('food_id')->nullable(); // Khóa ngoại liên kết với bảng foods, có thể null
            $table->integer('blog_id')->nullable(); // Khóa ngoại liên kết với bảng blogs, có thể null
            $table->dateTime('time'); // Cột time (thời gian đánh giá, datetime)
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
        Schema::dropIfExists('rates'); // Xóa bảng nếu rollback
    }
}