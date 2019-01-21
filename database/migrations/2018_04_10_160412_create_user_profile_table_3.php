<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserProfileTable3 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_profiles', function(Blueprint $table){
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->string('username')->unique();
            $table->string('fullname')->nullable();
            $table->char('gender')->nullable('Male');
            $table->date('birthday')->nullable();
            $table->string('phone')->nullable();
            $table->string('profession')->nullable();
            $table->string('photo')->default('images/unknown.png'); 
            $table->string('city')->nullable($value = true);                        
            $table->string('sociallinks')->nullable($value = true);
            $table->string('portfoliolinks')->nullable($value = true);
            $table->text('address')->nullable($value=true);
            $table->longText('aboutme')->nullable();

            //For achievement 
            // $table->string('award_title');
            // $table->string('award_link')->nullable($value = true);
            // $table->string('award_issuer');
            // $table->string('award_month');
            // $table->integer('award_year');            
            // $table->text('award_description');   
            
            //For experience
            // $table->string('exp_title');
            // $table->string('exp_link')->nullable($value = true);
            // $table->string('exp_company');
            // $table->string('exp_position');
            // $table->string('exp_location');
            // $table->string('exp_monthf');
            // $table->integer('exp_yearf');            
            // $table->string('exp_montht');
            // $table->integer('exp_yeart');            
            // $table->text('exp_description');  

            //For language
            // $table->string('language');
            // $table->string('lang_proficiency');

            //For skill
            // $table->string('skill');
            // $table->string('skill_proficiency'); 
            
            //For interest
            // $table->string('interest');

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
        Schema::drop('user_profiles');
    }
}
