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
        Schema::create('inventory_items', function (Blueprint $table) {
            $table->id();

            $table->integer('inventory_id');
            $table->integer('product_id');
            
            // أسعار التكلفة
            $table->decimal('last_cost_price', 30, 20)->nullable(); // آخر سعر تكلفة للصنف
            $table->decimal('avg_cost_price', 30, 20)->nullable();  // متوسط تكلفة الصنف
            
            $table->decimal('daftry_qty', 30, 20)->default(0)->comment('الكمية الدفترية كمية السيستم');
            $table->decimal('fealy_qty', 30, 20)->nullable()->comment('الكمية الفعلية كمية المخزن');             
            $table->decimal('difference_qty', 30, 20)->nullable()->comment('الفرق بين الفعلي والدفتري كميات'); 
        
            // القيم المالية للفرق
            $table->decimal('difference_value_last_cost', 30, 20)->nullable()->comment('الفرق بين الفعلي والدفتري مالي اخر سعر تكلفة');
            $table->decimal('difference_value_avg_cost', 30, 20)->nullable()->comment('الفرق بين الفعلي والدفتري مالي متوسط سعر تكلفة');

            $table->integer('updated_by');
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
        Schema::dropIfExists('inventory_items');
    }
};