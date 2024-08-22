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
        Schema::create('store_dets', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->integer('year_id');
            $table->integer('bill_head_id');
            $table->integer('bill_body_id');
            $table->integer('product_id');
            $table->integer('product_num_unit');
            $table->string('quantity');
            $table->string('quantity_all');
            $table->string('product_sellPrice');
            $table->string('product_purchasePrice');
            $table->string('product_avg');
            $table->string('product_cost');
            $table->date('date')->nullable();
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
        Schema::dropIfExists('store_dets');
    }
};
