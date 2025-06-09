<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImagesTable extends Migration
{
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->id(); // Khóa chính, tự động tăng
            $table->integer('id_rate')->nullable();
            $table->integer('id_food')->nullable();
            $table->string('img'); // Cột lưu đường dẫn hoặc URL hình ảnh
            $table->timestamps(); // Thêm cột created_at và updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('images'); // Xóa bảng nếu rollback
    }
}