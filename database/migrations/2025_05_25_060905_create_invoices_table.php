<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id(); // Cột ID (khóa chính, tự động tăng)
            $table->foreignId('table_id')->constrained('tables')->onDelete('cascade'); // Khóa ngoại liên kết với bảng tables
            $table->foreignId('order_id')->constrained('orders')->onDelete('cascade'); // Khóa ngoại liên kết với bảng orders
            $table->decimal('totalprice', 10, 2); // Cột totalprice (tổng giá trị trước giảm giá, decimal)
            $table->string('voucher')->nullable(); // Cột Voucher (mã giảm giá, varchar, có thể null)
            $table->decimal('total_bill', 10, 2); // Cột totalBill (tổng hóa đơn sau giảm giá, decimal)
            $table->foreignId('typepayment_id')->constrained('typepayments')->onDelete('cascade'); // Khóa ngoại liên kết với bảng typepayments
            $table->dateTime('time'); // Cột time (thời gian tạo hóa đơn, datetime)
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
        Schema::dropIfExists('invoices'); // Xóa bảng nếu rollback
    }
}