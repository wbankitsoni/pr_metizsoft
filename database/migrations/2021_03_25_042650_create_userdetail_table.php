<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserdetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_details', function (Blueprint $table) {

            $table->id();
            $table->string('FirstName');
            $table->string('LastName');
            $table->string('Email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('Phone');
            $table->string('Address');
            $table->string('Country');
            $table->string('State');
            $table->string('City');
            $table->string('ZipCode');
            $table->string('Gender');
            $table->string('Hobbies');
            $table->string('Image');
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
       Schema::dropIfExists('user_details');
    }
}
