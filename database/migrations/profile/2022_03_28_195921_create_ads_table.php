<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ads', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('google_id')->unsigned()->default(0);
            $table->integer('group_id')->unsigned();
            $table->text('headlines');
            $table->text('descriptions');
            $table->text('urls');
            $table->boolean('is_active')->default(false);
            $table->boolean('is_exist')->default(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ads');
    }
}
