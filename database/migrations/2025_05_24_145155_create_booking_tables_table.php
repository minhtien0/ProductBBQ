<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('booking_tables', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->string('nameuser'); // Cột nameuser (varchar)
            $table->string('sdt'); // Cột sdt (số điện thoại, varchar)
            $table->integer('quantitypeople'); // Cột quantitypeople (số lượng người, integer)
            $table->dateTime('time_booking'); // Cột time_booking (datetime)
            $table->foreignId('table_id')->constrained('tables')->onDelete('cascade'); // Khóa ngoại liên kết với bảng tables
            $table->dateTime('time_order'); // Cột time_order (datetime)
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
        Schema::dropIfExists('booking_tables'); // Xóa bảng nếu rollback
    }
}