<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('helps', function (Blueprint $table) {
        $table->string('name')->nullable()->after('content'); // có thể đổi vị trí after nếu muốn
    });
}

public function down()
{
    Schema::table('helps', function (Blueprint $table) {
        $table->dropColumn('name');
    });
}

};
