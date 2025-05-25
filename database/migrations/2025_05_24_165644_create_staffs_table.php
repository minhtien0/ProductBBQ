<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStaffsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('staffs', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->string('fullname'); // Cột fullname (varchar)
            $table->string('code_nv')->unique(); // Cột code_nv (varchar, duy nhất)
            $table->date('date_of_birth'); // Cột date_of_birth (date)
            $table->string('gender'); // Cột gender (varchar)
            $table->string('SDT'); // Cột SDT (số điện thoại, varchar)
            $table->string('CCCD')->unique(); // Cột CCCD (varchar, duy nhất)
            $table->string('status'); // Cột status (varchar)
            $table->string('address'); // Cột address (varchar)
            $table->string('email')->nullable(); // Cột Email (varchar, có thể null)
            $table->dateTime('time_work'); // Cột time_work (datetime)
            $table->foreignId('branch_id')->constrained('branchs')->onDelete('cascade'); // Khóa ngoại liên kết với bảng branches
            $table->string('type'); // Cột type (varchar)
            $table->string('avata')->nullable(); // Cột avata (varchar, có thể null)
            $table->string('STK')->nullable(); // Cột STK (số tài khoản, varchar, có thể null)
            $table->string('bank')->nullable(); // Cột bank (varchar, có thể null)
            $table->decimal('hourly_wage', 8, 2)->nullable(); // Cột hourly_wage (decimal, có thể null)
            $table->decimal('Basic_Salary', 10, 2)->nullable(); // Cột Basic_Salary (decimal, có thể null)
            $table->string('role'); // Cột role (varchar)
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
        Schema::dropIfExists('staffs'); // Xóa bảng nếu rollback
    }
}