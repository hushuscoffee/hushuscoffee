<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFavouritesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedInteger('article_id')->nullable();
            $table->unsignedInteger('brewing_id')->nullable();
            $table->unsignedInteger('recipe_id')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')->on('users')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->foreign('article_id')
                ->references('id')->on('articles')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('brewing_id')
                ->references('id')->on('brewings')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->foreign('recipe_id')
                ->references('id')->on('recipes')
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('favourites');
    }
}
