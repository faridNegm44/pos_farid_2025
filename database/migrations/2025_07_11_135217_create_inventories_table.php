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
        Schema::create('inventories', function (Blueprint $table) {
            $table->id();
            $table->date('date')->nullable();
            $table->integer('supervisor_1');
            $table->integer('supervisor_2')->nullable();
            $table->integer('supervisor_3')->nullable();
            $table->enum('status', ['جاري الجرد', 'تم الاعتماد', 'ملغي'])->default('جاري الجرد');
            $table->integer('user_id');
            $table->integer('year_id');
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('inventories');
    }
};