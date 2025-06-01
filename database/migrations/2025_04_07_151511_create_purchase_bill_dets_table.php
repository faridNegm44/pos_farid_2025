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
        Schema::create('purchase_bill_dets', function (Blueprint $table) {
            $table->id();
            $table->integer('purchase_bill_id');
            $table->integer('product_id');
            $table->string('quantity');
            $table->string('cost_price');
            $table->string('sale_price')->default(0);
            $table->string('bonus')->default(0);
            $table->string('discount')->default(0);
            $table->string('tax')->default(0);
            $table->string('vat')->default(0);
            $table->string('notes')->nullable();
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
        Schema::dropIfExists('purchase_bill_dets');
    }
};
