<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vouchers', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->string('code')->unique(); // Cột Code (varchar, duy nhất)
            $table->decimal('value', 8, 2); // Cột value (decimal, ví dụ: 123456.78)
            $table->dateTime('time_start'); // Cột time_start (datetime)
            $table->dateTime('time_end'); // Cột time_end (datetime)
            $table->integer('quantity'); // Cột quantity (số lượng, integer)
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
        Schema::dropIfExists('vouchers'); // Xóa bảng nếu rollback
    }
}