<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\GoogleAdsAccountCampaign;
use App\Models\GoogleAdsAccount;

class GoogleAdsAccountCampaignSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Google Ads Account Campaigns...');
        foreach (GoogleAdsAccount::all() as $googleAdsAccount) {
            GoogleAdsAccountCampaign::factory()->count(5)->create(['google_ads_account_id' => $googleAdsAccount->id]);
        }
    }
}
