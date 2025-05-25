<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->foreignId('staff_id')->constrained('staffs')->onDelete('cascade'); // Khóa ngoại liên kết với bảng staffs
            $table->dateTime('datetime'); // Cột datetime (thời gian tính lương, datetime)
            $table->decimal('basic_salary', 10, 2); // Cột basic_salary (lương cơ bản, decimal)
            $table->decimal('ot_salary', 10, 2)->nullable(); // Cột ot_salary (lương làm thêm giờ, decimal, có thể null)
            $table->decimal('tip', 10, 2)->nullable(); // Cột tip (tiền tip, decimal, có thể null)
            $table->decimal('bonus', 10, 2)->nullable(); // Cột bonus (thưởng, decimal, có thể null)
            $table->string('status'); // Cột status (trạng thái lương, varchar)
            $table->decimal('deduction_fee', 10, 2)->nullable(); // Cột deduction_fee (phí khấu trừ, decimal, có thể null)
            $table->text('note')->nullable(); // Cột note (ghi chú, text, có thể null)
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
        Schema::dropIfExists('salaries'); // Xóa bảng nếu rollback
    }
}