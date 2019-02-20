<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('title');
            $table->string('link')->nullable();
            $table->string('company');
            $table->string('position');
            $table->string('location');
            $table->integer('status');
            $table->string('monthf');
            $table->integer('yearf');            
            $table->string('montht')->nullable();
            $table->integer('yeart')->nullable();            
            $table->text('description');
            $table->timestamps();

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
        Schema::drop('experiences');
    }
}
