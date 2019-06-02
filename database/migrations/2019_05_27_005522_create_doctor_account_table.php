<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('doctor_accounts', function (Blueprint $table) {
            $table->increments('id');     
            $table->string('doctor_name', 100);  
            $table->string('handphone')->index()->unique();                               
            $table->string('idi_number')->index()->unique();
            $table->string('password');
            $table->string('api_token')->unique()->nulllable();
            $table->string('web_token')->unique()->nulllable();
            $table->string('specialist_id');
            $table->string('about');
            $table->string('account_verified');
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
        Schema::dropIfExists('doctor_accounts');
    }
}
