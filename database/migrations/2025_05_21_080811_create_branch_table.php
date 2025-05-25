<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBranchTable extends Migration
{
    public function up()
    {
        Schema::create('branchs', function (Blueprint $table) {
            $table->id(); // Id (auto-incrementing primary key)
            $table->string('name'); // Tên (branch name)
            $table->string('address')->nullable(); // Địa chỉ (address, nullable)
            $table->timestamps(); // Created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('branchs');
    }
}