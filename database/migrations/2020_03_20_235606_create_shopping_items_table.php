<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_items', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('shoppingList_id');
            $table->foreign('shoppingList_id')->references('id')->on('shopping_lists');
            $table->uuid('product_id');
            $table->foreign('product_id')->references('id')->on('product');

            $table->decimal('quantity', '10', '3')->default(0.0);

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
        Schema::dropIfExists('shopping_items');
    }
}
