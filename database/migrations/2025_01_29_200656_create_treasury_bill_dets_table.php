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
        Schema::create('treasury_bill_dets', function (Blueprint $table) {
            $table->id();
            $table->integer('num_order');
            $table->date('date');
            $table->integer('treasury_id');
            $table->string('treasury_type');
            $table->integer('bill_id');
            $table->string('bill_type');
            $table->integer('client_supplier_id');
            $table->decimal('money', 15, 2)->default(0);
            $table->integer('transaction_from')->nullable();
            $table->integer('transaction_to')->nullable();
            $table->string('notes')->nullable();
            $table->integer('user_id');
            $table->integer('year_id');
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
        Schema::dropIfExists('treasury_bill_dets');
    }
};
