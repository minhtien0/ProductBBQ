<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimekeepingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('timekeepings', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->foreignId('staff_id')->constrained('staffs')->onDelete('cascade'); // Khóa ngoại liên kết với bảng staffs
            $table->foreignId('job_id')->constrained('jobs')->onDelete('cascade'); // Khóa ngoại liên kết với bảng jobs
            $table->date('day'); // Cột day (date)
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
        Schema::dropIfExists('timekeepings'); // Xóa bảng nếu rollback
    }
}