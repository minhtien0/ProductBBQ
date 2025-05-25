<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_details', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Khóa ngoại liên kết với bảng orders
            $table->foreignId('product_id')->constrained('foods')->onDelete('cascade'); // Khóa ngoại liên kết với bảng foods
            $table->integer('quantity'); // Cột quantity (số lượng, integer)
            $table->timestamp('time'); // Cột create_at (timestamp)
            $table->string('status'); // Cột status (varchar)
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
        Schema::dropIfExists('order_details'); // Xóa bảng nếu rollback
    }
}