<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOvertimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('overtimes', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->foreignId('staff_id')->constrained('staffs')->onDelete('cascade'); // Khóa ngoại liên kết với bảng staffs
            $table->dateTime('time'); // Cột time (datetime)
            $table->decimal('quantity', 5, 2); // Cột quantity (số giờ làm thêm, decimal)
            $table->text('note')->nullable(); // Cột note (text, có thể null)
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
        Schema::dropIfExists('overtimes'); // Xóa bảng nếu rollback
    }
}