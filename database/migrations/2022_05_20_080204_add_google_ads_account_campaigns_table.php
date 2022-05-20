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
        Schema::create('google_ads_account_campaigns', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->unique();
            $table->bigInteger('google_ads_account_id')->unsigned();
            $table->string('name');
        });

        Schema::table('google_ads_account_campaigns', function (Blueprint $table) {
            $table->foreign('google_ads_account_id')->references('id')->on('google_ads_accounts')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('google_ads_account_campaigns', function (Blueprint $table) {
            $table->dropForeign('google_ads_account_campaigns_google_ads_account_id_foreign');
        });

        Schema::drop('google_ads_account_campaigns');

    }
};
