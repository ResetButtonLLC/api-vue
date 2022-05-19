<?php

namespace Database\Seeders;

use App\Models\GoogleAdsAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoogleAdsAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Google Ads Accounts...');
        GoogleAdsAccount::factory()->count(30)->create();
    }
}
