<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersTableMakeGenderAndBirthdayNullable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable()->change(); // Cập nhật cột gender để có thể null
            $table->date('birthday')->nullable()->change(); // Cập nhật cột birthday để có thể null
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('gender')->nullable(false)->change(); // Hoàn tác: gender không thể null
            $table->date('birthday')->nullable(false)->change(); // Hoàn tác: birthday không thể null
        });
    }
}