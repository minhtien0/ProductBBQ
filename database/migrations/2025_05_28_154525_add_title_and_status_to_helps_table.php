<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTitleAndStatusToHelpsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('helps', function (Blueprint $table) {
            $table->string('title')->after('id'); // Cột title (varchar, thêm sau cột id)
            $table->string('status')->after('content'); // Cột status (varchar, thêm sau cột content)
        });
    }

    /**
     * Reverse the migrations.s
     *
     * @return void
     */
    public function down()
    {
        Schema::table('helps', function (Blueprint $table) {
            $table->dropColumn(['title', 'status']); // Xóa cột title và status nếu rollback
        });
    }
}