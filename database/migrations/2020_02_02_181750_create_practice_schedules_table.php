<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePracticeSchedulesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('practice_schedules', function (Blueprint $table) {
            $table->increments('p_id',7);            
            $table->integer('s_e_id')->unsigned();                        
            $table->integer('e_r_id')->unsigned();                        
            $table->integer('u_id')->unsigned();                        
            $table->json('description');
            $table->date('date');
            $table->time('time');
            $table->foreign('s_e_id')->references('s_e_id')->on('sub_event_masters')->onUpdade('cascade')->onDelete('cascade');
            $table->foreign('e_r_id')->references('e_r_id')->on('event_registrations')->onUpdade('cascade')->onDelete('cascade');
            $table->foreign('u_id')->references('u_id')->on('user_masters')->onUpdade('cascade')->onDelete('cascade');            
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
        Schema::dropIfExists('practice_schedules');
    }
}
