<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoogleAdsAccount>
 */
class GoogleAdsAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'id' => $this->faker->randomDigitNotZero().$this->faker->numberBetween(100000000,999999999),
            'name' => $this->faker->words(2,true),
            'domain' => $this->faker->domainName(),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
