<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientBookingRequestTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('patient_booking_request', function (Blueprint $table) {
            $table->bigIncrements('booking_request_id');
            $table->integer('patient_id')->unsigned();    
            $table->foreign('patient_id')->references('patient_id')->on('patient_accounts');                                     
            $table->biginteger('schedule_detail_id')->unsigned();   
            $table->foreign('schedule_detail_id')->references('schedule_detail_id')->on('doctor_schedule_detail');                                                
            $table->integer('rates_id')->unsigned(); 
            $table->foreign('rates_id')->references('rates_id')->on('payment_rates')->onDelete('CASCADE');                                                   
            $table->text('remarks')->nullable();   
            $table->integer('payment_method_id')->unsigned();           
            $table->foreign('payment_method_id')->references('method_id')->on('payment_method')->onDelete('CASCADE');                                                               
            $table->boolean('is_paid')->default(0);   
            $table->integer('queue_number')->nullable();  
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
        Schema::dropIfExists('patient_Booking_Request');
    }
}
