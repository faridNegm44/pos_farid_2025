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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('shortCode')->nullable();
            $table->string('natCode')->nullable();
            $table->string('nameAr')->unique();
            $table->string('nameEn')->unique()->nullable();
            $table->integer('store');
            $table->integer('company')->nullable();
            $table->integer('category')->nullable();
            $table->string('stockAlert')->default(0);
            $table->enum('divisible', [1, 0])->default(0);
            $table->string('sellPrice');
            $table->string('avgPrice');
            $table->string('purchasePrice');
            $table->string('discountPercentage')->default(0);
            $table->string('tax')->default(0);
            $table->string('quantity')->default(0);
            $table->string('firstPeriodCount')->default(0);
            $table->integer('bigUnit')->nullable();
            $table->integer('smallUnit');
            $table->string('smallUnitPrice');
            $table->string('smallUnitNumbers');
            $table->enum('status', [1, 0])->default(1);
            $table->string('image')->default('df_image.png');
            $table->string('desc')->nullable();
            $table->enum('offerDiscountStatus', [1, 0])->default(0);
            $table->string('offerDiscountPercentage')->nullable();
            $table->dateTime('offerStart')->nullable();
            $table->dateTime('offerEnd')->nullable();
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
        Schema::dropIfExists('products');
    }
};
