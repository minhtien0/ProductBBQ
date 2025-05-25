<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->string('code')->unique(); // Cột code (varchar, duy nhất)
            $table->foreignId('table_id')->constrained('tables')->onDelete('cascade'); // Khóa ngoại liên kết với bảng tables
            $table->timestamp('create_at'); // Cột create_at (timestamp)
            $table->string('status'); // Cột status (varchar)
            $table->timestamp('updated_at')->nullable(); // Cột updated_at (timestamp, có thể null)
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders'); // Xóa bảng nếu rollback
    }
}