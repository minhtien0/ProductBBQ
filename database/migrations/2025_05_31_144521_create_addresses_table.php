<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id(); // Cột id (khóa chính, tự động tăng)
            $table->string('name'); // Cột name (tên người nhận, varchar)
            $table->string('sdt'); // Cột sdt (số điện thoại, varchar)
            $table->string('house_number'); // Cột house_number (số nhà, varchar)
            $table->string('ward'); // Cột ward (phường/xã, varchar)
            $table->string('district'); // Cột district (quận/huyện, varchar)
            $table->string('city'); // Cột city (thành phố/tỉnh, varchar)
            $table->boolean('default')->default(false); // Cột default (địa chỉ mặc định, boolean)
            $table->text('note')->nullable(); // Cột note (ghi chú, text, có thể null)
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Khóa ngoại liên kết với bảng users
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
        Schema::dropIfExists('addresses'); // Xóa bảng nếu rollback
    }
}