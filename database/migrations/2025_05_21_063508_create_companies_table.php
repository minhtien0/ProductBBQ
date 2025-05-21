<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id(); // ID (auto-incrementing primary key)
            $table->string('name'); // Tên (company name)
            $table->string('address')->nullable(); // Địa chỉ (address, nullable in case it's optional)
            $table->string('sdt')->nullable(); // SĐT (phone number, nullable)
            $table->string('email')->unique()->nullable(); // Email (unique, nullable)
            $table->time('timeopen')->nullable(); // Thời Gian Mở Cửa (opening time, nullable)
            $table->time('timeclose')->nullable(); // Thời Gian Đóng Cửa (closing time, nullable)
            $table->string('facebook')->nullable(); // Facebook URL or ID (nullable)
            $table->string('telegram')->nullable(); // Telegram URL or ID (nullable)
            $table->string('instagram')->nullable(); // Instagram URL or ID (nullable)
            $table->timestamps(); // Created_at and updated_at columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}