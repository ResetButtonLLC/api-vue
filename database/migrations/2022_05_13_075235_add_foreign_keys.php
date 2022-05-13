<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('project_user', function (Blueprint $table) {
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->bigInteger('project_id')->unsigned()->change();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->foreign('project_id')->references('id')->on('projects')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('project_user', function (Blueprint $table) {
            $table->dropForeign('project_user_project_id_foreign');
            $table->dropForeign('project_user_user_id_foreign');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign('profiles_project_id_foreign');
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->integer('project_id')->unsigned()->change();
        });
    }
};
