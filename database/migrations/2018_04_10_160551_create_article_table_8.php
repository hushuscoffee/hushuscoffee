<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticleTable8 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function(Blueprint $table){
            $table->increments('id');
            $table->string('title');
            $table->longText('description');
            $table->string('slug')->unique();
            $table->string('file');
            $table->integer('comment_count')->default(0);
            $table->integer('upvote_count')->default(0);
            $table->integer('downvote_count')->default(0);
            $table->unsignedInteger('id_status');
            $table->unsignedInteger('id_shared');
            $table->unsignedInteger('id_category');
            $table->unsignedInteger('id_user');
            $table->timestamps();
            
            $table->foreign('id_status')       
            ->references('id')->on('master_statuss')       
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
            $table->foreign('id_shared')       
            ->references('id')->on('master_shareds')       
            ->onDelete('cascade')
            ->onUpdate('cascade');

            $table->foreign('id_category')       
            ->references('id')->on('master_categorys')       
            ->onDelete('cascade')
            ->onUpdate('cascade');
            
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
        Schema::drop('articles'); 
    }
}
