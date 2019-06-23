<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('patient_accounts', function (Blueprint $table) {
            $table->increments('patient_id');  
            $table->string('patient_name',100);                     
            $table->string('handphone')->index()->unique(); 
            $table->string('email')->index()->unique();                                                            
            $table->string('birth_place',100);
            $table->date('birth_date');
            $table->string('gender',10);
            $table->string('photo')->nullable();
            $table->text('Address')->nullable();
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
        Schema::dropIfExists('patient_accounts');
    }
}
