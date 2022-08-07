<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\GoogleAdsAccount;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoogleAdsAccountCampaign>
 */
class GoogleAdsAccountCampaignFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        return [
            'id' => $this->faker->numberBetween(1000000),
       //     'google_ads_account_id' => обязательное поле из связи
            'name' => $this->faker->words(3,true),
        ];
    }
}
