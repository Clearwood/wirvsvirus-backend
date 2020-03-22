<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jobs', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('supplier_id')->nullable();
            $table->foreign('supplier_id')->references('id')->on('suppliers');
            $table->uuid('consumer_id');
            $table->foreign('consumer_id')->references('id')->on('consumers');
            $table->uuid('shoppingList_id');
            $table->foreign('shoppingList_id')->references('id')->on('shopping_lists');
            $table->uuid('shop_id')->nullable();
            $table->foreign('shop_id')->references('id')->on('shops');

            $table->string('status')->default('pending');
            $table->string('receipt')->nullable()->comment('url of the image of the receipt');
            $table->integer('paymentToShop')->nullable()->comment('The amount paid to the shop by the supplier');
            $table->integer('paymentToSupplier')->nullable()->comment('The amount given to the supplier by the consumer');
            $table->dateTime('deliveryTime')->nullable()->comment('Scheduled time for the delivery');
            $table->dateTime('acceptedJobTime')->nullable();

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
        Schema::dropIfExists('jobs');
    }
}
