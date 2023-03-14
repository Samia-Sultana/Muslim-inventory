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
        Schema::table('purchases', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('sku')->nullable();
            $table->string('thumbnail')->nullable();
            $table->string('carat');
            $table->string('weight');
            $table->string('bangla_weight');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('purchases', function (Blueprint $table) {
            $table->dropColumn('carat');
            $table->dropColumn('weight');
            $table->dropColumn('bangla_weight');
            $table->dropColumn('name');
            $table->dropColumn('sku');
            $table->dropColumn('thumbnail');
        });
    }
};
