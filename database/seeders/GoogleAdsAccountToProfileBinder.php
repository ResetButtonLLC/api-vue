<?php

namespace Database\Seeders;

use App\Models\GoogleAdsAccount;
use App\Models\Profile;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoogleAdsAccountToProfileBinder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Bind Google Accounts to Profiles');
        foreach (Profile::all() as $profile) {
            $profile->google_ads_account_id = GoogleAdsAccount::inRandomOrder()->first()->id;
            $profile->save();
        }
    }
}
