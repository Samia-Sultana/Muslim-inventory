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
        Schema::create('purchases', function (Blueprint $table) {
            $table->id();
            $table->string('product_id')->nullable();
            $table->string('supplier_id')->nullable();
            $table->string('buying_price')->nullable();
            $table->string('selling_price')->nullable();
            $table->string('purchase_date')->nullable();
            $table->string('expiry_date')->nullable();
            $table->string('batch_no')->nullable();
            $table->string('wrack_no')->nullable();
            $table->string('warehouse')->nullable();
            $table->string('total_qty')->nullable();
            $table->string('available_qty')->nullable();
            $table->string('barcode')->nullable();
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
        Schema::dropIfExists('purchases');
    }
};
