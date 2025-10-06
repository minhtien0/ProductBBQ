<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmailVerificationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('email_verifications', function (Blueprint $table) {
            $table->id();
            $table->string('user')->unique(); // username hoặc mã người dùng
            $table->string('password'); // mật khẩu mã hóa (hashed)
            $table->string('sdt')->unique(); // số điện thoại
            $table->string('email')->unique(); // email người dùng
            $table->string('fullname'); // họ tên đầy đủ
            $table->string('email_verify_token', 255)->unique(); // token xác minh email
            $table->timestamp('token_created_at')->nullable(); // thời gian tạo token
            $table->timestamps(); // created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('email_verifications');
    }
}
