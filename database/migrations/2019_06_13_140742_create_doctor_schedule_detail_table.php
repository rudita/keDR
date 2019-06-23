<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorScheduleDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_schedule_detail', function (Blueprint $table) {
            $table->bigIncrements('schedule_detail_id');  
            $table->integer('schedule_id')->unsigned();                
            $table->foreign('schedule_id')->references('schedule_id')->on('doctor_schedule');                                                                                                                
            $table->date('practice_date'); 
            $table->boolean('is_active')->default(0); 
            $table->boolean('is_done')->default(0); 
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
        Schema::dropIfExists('doctor_schedule_detail');
    }
}
