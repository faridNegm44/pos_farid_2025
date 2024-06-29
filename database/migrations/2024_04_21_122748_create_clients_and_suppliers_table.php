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
        Schema::create('clients_and_suppliers', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('client_supplier_type');
            $table->bigInteger('code');
            $table->string('name');
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('phone')->default(0);
            $table->string('image')->default('df_image.png');
            $table->string('type_payment')->default('كاش');
            $table->string('debit')->default(0);
            $table->string('debit_limit')->default(0);
            $table->string('money')->default(0);
            $table->boolean('status')->default(1);
            $table->string('commercial_register')->default(0);
            $table->string('tax_card')->default(0);
            $table->string('vat_registration_code')->default(0);
            $table->string('name_of_commissioner')->default(0);
            $table->string('phone_of_commissioner')->default(0);
            $table->string('note')->nullable();
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
        Schema::dropIfExists('clients_and_suppliers');
    }
};
