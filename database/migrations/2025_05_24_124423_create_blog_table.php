<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->string('title'); // Cột Tiêu Đề (varchar)
            $table->string('type'); // Cột Loại (varchar)
            $table->text('content'); // Cột Nội Dung (text, phù hợp cho nội dung dài)
            $table->dateTime('time'); // Cột Ngày Đăng (datetime)
            $table->string('image')->nullable(); // Cột Hình Ảnh (varchar, có thể null)
            $table->string('slug')->unique(); // Cột slug (varchar, duy nhất)
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
        Schema::dropIfExists('blog'); // Xóa bảng nếu rollback
    }
}