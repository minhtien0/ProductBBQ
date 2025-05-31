<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Auto-incrementing primary key 'id'
            $table->string('user')->unique(); // Username, unique
            $table->string('password'); // Password (hashed)
            $table->string('sdt'); // Phone number
            $table->string('email')->unique(); // Email, unique
            $table->string('fullname'); // Full name
            $table->date('birthday'); // Birthday
            $table->string('gender'); // Gender
            $table->string('avatar')->nullable(); // Avatar path, optional
            $table->string('role'); // User role
            $table->timestamps(); // 'created_at' and 'updated_at' columns
        });
    }

    public function down()
    {
        Schema::dropIfExists('users'); // Drops the table if it exists
    }
}