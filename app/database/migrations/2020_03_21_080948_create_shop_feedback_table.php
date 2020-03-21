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
        Schema::create('shop_feedbacks', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('supplier_id');
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->uuid('shop_id');
            $table->foreign('shop_id')->references('id')->on('shops');

            $table->string('amountOfCustomers')->default('medium');
            $table->string('productAvailability')->default('medium');

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
        Schema::dropIfExists('shop_feedbacks');
    }
}
