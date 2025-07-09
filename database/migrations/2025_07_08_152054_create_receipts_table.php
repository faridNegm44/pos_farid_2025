<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('receipts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('payer_type');
            $table->integer('payer_id');
            $table->decimal('amount', 30, 20);
            $table->string('amount_in_words')->nullable()->comment('المبلغ بالحروف');

            $table->enum('payment_type', ['كاش', 'شيك'])->default('كاش');
            $table->string('cheque_number')->nullable();
            $table->string('cheque_bank')->nullable();
            $table->date('cheque_date')->nullable();

            $table->date('receipt_date')->comment('تاريخ تحرير الإيصال');
            $table->enum('status', ['جاري التحصيل', 'تم التحصيل', 'ملغى'])->default('جاري التحصيل')->comment('حالة الإيصال');
            $table->text('notes')->nullable();

            $table->integer('user_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('receipts');
    }
};
