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
        Schema::create('purchase_bills', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['فاتورة شراء جديدة', 'مرتجع شراء']);
            $table->integer('num_order');
            $table->string('custom_bill_num')->default('')->unique();
            $table->integer('supplier_id');
            $table->integer('treasury_id')->nullable();
            $table->date('custom_date')->nullable();
            $table->integer('user_id');
            $table->integer('year_id');
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
        Schema::dropIfExists('purchase_bills');
    }
};
