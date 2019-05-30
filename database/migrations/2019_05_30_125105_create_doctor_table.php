<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_accounts', function(Blueprint $table){
            $table->increments('id');
            $table->timestamps();
            $table->dateTime('deleted_at')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->string('password');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('photo');
            $table->string('invite_code');
            $table->string('invitation_code');
            $table->string('invitation_uri');
            $table->string('social_login_type');
            $table->string('social_login_id');
            $table->double('current_credits')->default(0);
            $table->integer('activated')->default(0);
            $table->integer('newsletter_subscribed')->default(0);
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
