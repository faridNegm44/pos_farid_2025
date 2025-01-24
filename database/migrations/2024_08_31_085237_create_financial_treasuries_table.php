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
        Schema::create('financial_treasuries', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->integer('userOne');
            $table->integer('userTwo')->nullable();
            $table->integer('userThree')->nullable();
            $table->integer('moneyFirstDuration')->default(0);
            $table->enum('status', [1, 0])->default(1);
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
        Schema::dropIfExists('financial_treasuries');
    }
};
