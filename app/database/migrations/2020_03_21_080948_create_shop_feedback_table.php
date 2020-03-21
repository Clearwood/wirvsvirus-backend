<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopFeedbackTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shop_feedback', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->uuid('shop_id')->nullable();
            $table->foreign('shop_id')->references('id')->on('shops');

            $table->string('amountOfCustomers');
            $table->string('productAvailability');

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
        Schema::dropIfExists('shop_feedback');
    }
}
