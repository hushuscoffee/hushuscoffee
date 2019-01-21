<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTagsTable22 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articletags', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_article');
            $table->unsignedInteger('id_tag');
            $table->timestamps();

            $table->foreign('id_article')       
            ->references('id')->on('articles')       
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_tag')       
            ->references('id')->on('tags')       
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
        Schema::drop('articletags'); 
        //
    }
}
