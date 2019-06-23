<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeToNullableAtDoctorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('doctor_accounts', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
        });

        Schema::table('doctor_accounts', function (Blueprint $table) {
            $table->string('about')->nullable()->change();
        });

        Schema::table('doctor_accounts', function (Blueprint $table) {
            $table->string('photo')->nullable()->change();
        });

        Schema::table('doctor_accounts', function (Blueprint $table) {
            $table->string('activated')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
