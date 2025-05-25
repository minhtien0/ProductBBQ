<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tips', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->foreignId('staff_id')->constrained('staffs')->onDelete('cascade'); // Khóa ngoại liên kết với bảng staffs
            $table->decimal('tip_amount', 8, 2); // Cột tip_amount (decimal, ví dụ: 123456.78)
            $table->dateTime('time'); // Cột time (datetime)
            $table->text('note')->nullable(); // Cột note (text, có thể null)
            $table->dateTime('create_at'); // Cột create_at (datetime)
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
        Schema::dropIfExists('tips'); // Xóa bảng nếu rollback
    }
}