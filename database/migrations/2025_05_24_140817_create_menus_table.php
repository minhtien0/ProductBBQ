<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menus', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->string('name'); // Cột name (varchar)
            $table->text('notes')->nullable(); // Cột notes (text, có thể null)
            $table->timestamp('create_at'); // Cột create_at (timestamp)
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
        Schema::dropIfExists('menus'); // Xóa bảng nếu rollback
    }
}