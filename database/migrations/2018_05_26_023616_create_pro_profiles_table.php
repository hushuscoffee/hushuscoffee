<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pro_profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_user');
            $table->string('username')->unique();
            $table->string('city');
            $table->string('job');
            $table->string('linkedin');
            $table->string('resume');
            $table->text('summary');
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
        Schema::dropIfExists('pro_profiles');
    }
}
