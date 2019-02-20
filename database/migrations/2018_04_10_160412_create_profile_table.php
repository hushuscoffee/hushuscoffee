<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('fullname')->nullable();
            $table->string('gender')->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('profession')->nullable();
            $table->string('photo')->default('unknown.png'); 
            $table->string('city')->nullable();                        
            $table->string('sociallinks')->nullable();
            $table->string('portfoliolinks')->nullable();
            $table->text('address')->nullable();
            $table->longText('aboutme')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('user_id')       
            ->references('id')->on('users')       
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
        Schema::drop('profiles');
    }
}
