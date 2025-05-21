<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTypePaymentsTable extends Migration
{
    public function up()
    {
        Schema::create('typepayments', function (Blueprint $table) {
            $table->id(); // ID (auto-incrementing primary key)
            $table->string('name'); // Tên Loại (category/type name)
            $table->timestamp('created_at')->useCurrent(); // Create_at (timestamp, auto-set to current time)
        });
    }

    public function down()
    {
        Schema::dropIfExists('typepayments');
    }
}