<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->string('db');
            $table->string('name');
            $table->string('feed_url')->nullable();
            $table->string('feed_file')->nullable();
            $table->enum('feed_type', ['unset', 'file', 'url'])->default('unset');
            $table->text('template')->nullable();
            $table->text('settings')->nullable();
            $table->text('autoupdates')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
