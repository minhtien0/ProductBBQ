<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('foods', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->string('name'); // Cột name (varchar)
            $table->text('description')->nullable(); // Cột description (text, có thể null)
            $table->string('image')->nullable(); // Cột image (varchar, có thể null)
            $table->decimal('price', 8, 2); // Cột price (decimal, ví dụ: 123456.78)
            $table->string('status'); // Cột status (varchar)
            $table->string('slug')->unique(); // Cột slug (varchar, duy nhất)
            $table->foreignId('type')->constrained('menus')->onDelete('cascade'); // Khóa ngoại liên kết với bảng menus
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
        Schema::dropIfExists('foods'); // Xóa bảng nếu rollback
    }

    
}