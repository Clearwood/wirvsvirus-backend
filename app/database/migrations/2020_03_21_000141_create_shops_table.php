<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shops', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->decimal('longitude', '10', '4');
            $table->decimal('latitude', '10', '4');
            $table->string('streetName')->nullable();
            $table->string('houseNumber')->nullable();
            $table->string('city')->nullable();
            $table->integer('postCode')->nullable();
            $table->string('extraAddressInformation')->nullable();

            $table->string('brand')->nullable();
            $table->string('name');
            $table->string('type');

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
        Schema::dropIfExists('shops');
    }
}
