<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShoppingListTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shopping_lists', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->uuid('consumer_id')->nullable();
            $table->foreign('consumer_id')->references('id')->on('consumers');

            $table->boolean('preferCheapProducts')->default(true);
            $table->integer('budget')->nullable()->comment('In euro-cent');

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
        Schema::dropIfExists('shopping_lists');
    }
}
