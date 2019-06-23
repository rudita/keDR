<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBannerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banner_promotion', function (Blueprint $table) {
            $table->increments('banner_id');  
            $table->string('banner_tag',100); 
            $table->string('banner_description',100);  
            $table->string('url',100);                     
            $table->string('order');  
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
        Schema::dropIfExists('banner_promotion');
    }
}
