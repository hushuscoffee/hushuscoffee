<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_achievements', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->string('username');
            $table->string('title');
            $table->string('link')->nullable($value = true);
            $table->string('issuer');
            $table->string('month');
            $table->integer('year');            
            $table->text('description');          
            $table->string('_token')->nullable($value = true);  
            $table->timestamps();

            $table->foreign('id_user')       
            ->references('id')->on('user_auths')       
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pro_achievements');
    }
}
