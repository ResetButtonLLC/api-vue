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
        Schema::create('google_ads_accounts', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->string('name');
            $table->string('domain');
            $table->boolean('is_active');
            $table->timestamps();
        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->bigInteger('google_id')->unsigned()->nullable()->default(null)->change();
            $table->renameColumn('google_id','google_ads_account_id');
            $table->foreign('google_ads_account_id')->references('id')->on('google_ads_accounts')->nullOnDelete();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('profiles', function (Blueprint $table) {
            $table->dropForeign('profiles_google_ads_account_id_foreign');
            $table->renameColumn('google_ads_account_id','google_id');

        });

        Schema::table('profiles', function (Blueprint $table) {
            $table->bigInteger('google_id')->unsigned()->default(0)->change();
        });

        Schema::drop('google_ads_accounts');
    }
};
