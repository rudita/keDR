<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeToNullableAtPatientTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('patient_accounts', function (Blueprint $table) {
            $table->string('email')->nullable()->change();
        });

        Schema::table('patient_accounts', function (Blueprint $table) {
            $table->string('birth_place')->nullable()->change();
        });

        Schema::table('patient_accounts', function (Blueprint $table) {
            $table->string('birth_date')->nullable()->change();
        });

        Schema::table('patient_accounts', function (Blueprint $table) {
            $table->string('gender')->nullable()->change();
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
