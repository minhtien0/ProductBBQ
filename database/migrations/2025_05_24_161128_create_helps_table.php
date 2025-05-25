<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('helps', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->string('purpose'); // Cột purpose (varchar)
            $table->string('question'); // Cột question (varchar)
            $table->string('sdt'); // Cột sdt (số điện thoại, varchar)
            $table->string('email')->nullable(); // Cột email (varchar, có thể null)
            $table->dateTime('time'); // Cột time (datetime)
            $table->text('content')->nullable(); // Cột content (text, có thể null)
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
        Schema::dropIfExists('helps'); // Xóa bảng nếu rollback
    }
}