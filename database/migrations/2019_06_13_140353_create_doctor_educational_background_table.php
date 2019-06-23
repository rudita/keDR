<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorEducationalBackgroundTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {       
        Schema::create('doctor_educational_background', function (Blueprint $table) {
            $table->increments('background_id');  
            $table->integer('doctor_id')->unsigned();                  
            $table->foreign('doctor_id')->references('doctor_id')->on('doctor_accounts')->onDelete('CASCADE');                                                                                                                                        
            $table->integer('specialist_id')->unsigned();  
            $table->foreign('specialist_id')->references('specialist_id')->on('doctor_accounts')->onDelete('CASCADE');                                                                                                                
            $table->string('university',100);
            $table->char('year',4);
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
        Schema::dropIfExists('doctor_educational_background');
    }
}
