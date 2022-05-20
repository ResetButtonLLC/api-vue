<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call([
            UserSeeder::class,
            GoogleAdsAccountSeeder::class,
            GoogleAdsAccountCampaignSeeder::class,
            ProjectAndProfileSeeder::class,
            //Standalone binders
                UsersToProjectsBinder::class,
                GoogleAdsAccountToProfileBinder::class,
        ]);

    }
}
