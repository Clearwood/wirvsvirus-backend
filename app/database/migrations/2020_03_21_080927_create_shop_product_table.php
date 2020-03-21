<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_product', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('shop_id')->nullable();
            $table->foreign('shop_id')->references('id')->on('shops');
            $table->uuid('product_id')->nullable();
            $table->foreign('product_id')->references('id')->on('products');
            
            $table->boolean('isAvailable');

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
        Schema::dropIfExists('shop_x_product');
    }
}
