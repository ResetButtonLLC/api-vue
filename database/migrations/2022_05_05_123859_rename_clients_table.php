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
        Schema::rename('clients', 'projects');
        Schema::table('client_user', function (Blueprint $table) {
            $table->renameColumn('client_id', 'project_id');
        });
        Schema::rename('client_user', 'project_user');
        Schema::table('profiles', function (Blueprint $table) {
            $table->renameColumn('client_id', 'project_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::rename('projects', 'clients');
        Schema::table('project_user', function (Blueprint $table) {
            $table->renameColumn('project_id', 'client_id');
        });
        Schema::rename('project_user', 'client_user');
        Schema::table('profiles', function (Blueprint $table) {
            $table->renameColumn('project_id', 'client_id');
        });
    }
};
