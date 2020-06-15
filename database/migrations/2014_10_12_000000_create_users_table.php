<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

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
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('username');
            $table->string('phone_no')->unique();
            $table->string('email', 255);
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            $table->string('street_adress');
            $table->unsignedInteger('division_id')->comment('Division Table Id');
            $table->unsignedInteger('district_id')->comment('District Table Id');

            $table->tinyInteger('verify')->default(0);
            $table->unsignedTinyInteger('status')->default(0)->comment('0=Inactive|1=Active|2=ban');
            $table->string('ip_adress')->nullable();
            $table->string('avatar')->nullable();
            $table->text('shipping_adress')->nullable();

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
