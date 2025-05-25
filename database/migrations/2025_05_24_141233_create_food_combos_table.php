<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodCombosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_combos', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->string('codecombo')->unique(); // Cột codecombo (varchar, duy nhất)
            $table->decimal('price', 8, 2); // Cột price (decimal, ví dụ: 123456.78)
            $table->text('note')->nullable(); // Cột note (text, có thể null)
            $table->timestamp('create_at'); // Cột create_at (timestamp)
            $table->string('image')->nullable(); // Cột image (varchar, có thể null)
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
        Schema::dropIfExists('food_combos'); // Xóa bảng nếu rollback
    }
}