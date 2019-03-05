<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecipesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recipes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->string('slug')->unique();
            $table->string('image');
            $table->longText('ingredients');
            $table->longText('tools');
            $table->longText('steps');
            $table->longText('step_images');
            $table->unsignedInteger('user_id');
            $table->unsignedInteger('status_id');
            $table->unsignedInteger('shared_id');
            $table->timestamps();
            $table->softDeletes();
            
            $table->foreign('status_id')       
            ->references('id')->on('status')       
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('shared_id')       
            ->references('id')->on('shareds')       
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
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
        Schema::drop('recipes');
    }
}
