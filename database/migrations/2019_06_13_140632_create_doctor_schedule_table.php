<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorScheduleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_schedule', function (Blueprint $table) {
            $table->increments('schedule_id');     
            $table->integer('doctor_id')->unsigned();  
            $table->foreign('doctor_id')->references('doctor_id')->on('doctor_accounts');                                                                                                    
            $table->string('practice_day',10); 
            $table->time('start_time'); 
            $table->time('end_time');    
            $table->integer('quota');                         
            $table->string('hospital_name',100);
            $table->string('longitude')->nullable();
            $table->string('latitude')->nullable();
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
        Schema::dropIfExists('doctor_schedule');
    }
}
