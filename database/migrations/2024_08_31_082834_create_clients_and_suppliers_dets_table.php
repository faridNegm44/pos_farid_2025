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
        Schema::create('clients_and_suppliers_dets', function (Blueprint $table) {
            $table->id();
            $table->integer('treasury_id');
            $table->integer('treasury_bill_head_id');
            $table->integer('treasury_bill_body_id');
            $table->integer('client_supplier_id');
            $table->string('money');
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
        Schema::dropIfExists('clients_and_suppliers_dets');
    }
};
