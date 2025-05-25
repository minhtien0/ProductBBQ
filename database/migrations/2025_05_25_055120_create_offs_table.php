<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('offs', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->foreignId('staff_id')->constrained('staffs')->onDelete('cascade'); // Khóa ngoại liên kết với bảng staffs
            $table->dateTime('time'); // Cột time (thời gian nghỉ, datetime)
            $table->string('type'); // Cột type (loại nghỉ, varchar, ví dụ: "sick", "personal")
            $table->text('reason'); // Cột reason (lý do nghỉ, text)
            $table->text('note')->nullable(); // Cột note (ghi chú, text, có thể null)
            $table->dateTime('sending_time'); // Cột sending_time (thời gian gửi yêu cầu, datetime)
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
        Schema::dropIfExists('offs'); // Xóa bảng nếu rollback
    }
}