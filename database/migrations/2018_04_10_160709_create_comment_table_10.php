<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentTable10 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function(Blueprint $table){
            $table->increments('id');
            $table->mediumText('text');
            $table->unsignedInteger('id_user');
            $table->unsignedInteger('id_article');
            $table->unsignedInteger('id_comment_parent')->nullable();
            $table->timestamps();
            
            $table->foreign('id_user')       
            ->references('id')->on('user_auths')       
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_article')       
            ->references('id')->on('articles')       
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_comment_parent')       
            ->references('id')->on('comments')       
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
        Schema::drop('comments'); 
    }
}
