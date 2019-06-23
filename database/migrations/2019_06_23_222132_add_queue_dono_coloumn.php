<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddQueueDonoColoumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_booking_request', function (Blueprint $table) {
            $table->text('queue_done')->nullable(true)->after('queue_number');           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('patient_booking_request', function (Blueprint $table) {
            $table->dropColumn('queue_done');
        });
    }
}
