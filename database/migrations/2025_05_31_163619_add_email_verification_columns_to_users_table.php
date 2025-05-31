<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailVerificationColumnsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('email_verify_token')->nullable()->after('role');
            $table->timestamp('token_created_at')->nullable()->after('email_verify_token');
            $table->timestamp('email_verified_at')->nullable()->after('token_created_at');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['email_verify_token', 'token_created_at', 'email_verified_at']);
        });
    }
}
