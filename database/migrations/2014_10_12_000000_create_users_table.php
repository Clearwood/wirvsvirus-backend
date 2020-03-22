<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->uuid('id')->primary();

            $table->string('firstName');
            $table->string('lastName');
            $table->date('birthday');

            $table->string('streetName');
            $table->string('houseNumber');
            $table->string('city');
            $table->integer('postCode');
            $table->string('extraAddressInformation')->nullable();

            $table->string('healthStatus')->default('quarantine');
            $table->boolean('isRiskGroup')->default(false);
            $table->string('phoneNumber');

            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->rememberToken();

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
        Schema::dropIfExists('users');
    }
}
