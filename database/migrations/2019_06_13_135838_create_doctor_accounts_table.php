<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorAccountsTable extends Migration
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
            $table->increments('doctor_id');  
            $table->string('doctor_name', 100);                     
            $table->string('idi_number')->index()->unique();
            $table->string('handphone',25)->index()->unique(); 
            $table->string('email')->index()->unique(); 
            $table->integer('specialist_id')->unsigned();                                                                       
            $table->foreign('specialist_id')->references('specialist_id')->on('doctor_specialist_type');                                                                                        
            $table->text('about')->nullable();
            $table->string('photo')->nullable();
            $table->boolean('activated')->default(0);
            $table->rememberToken();
            $table->timestamps();    
            $table->integer('user_id')->unsigned();           
            $table->foreign('user_id')->references('user_id')->on('acl_users');                                                                                        
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
