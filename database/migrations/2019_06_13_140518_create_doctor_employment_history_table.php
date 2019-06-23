<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDoctorEmploymentHistoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doctor_employment_history', function (Blueprint $table) {
            $table->increments('history_id');  
            $table->integer('doctor_id')->unsigned();                
            $table->foreign('doctor_id')->references('doctor_id')->on('doctor_accounts');                                                                                                                
            $table->string('hospital_name',100);          
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
        Schema::dropIfExists('doctor_employment_history');
    }
}
