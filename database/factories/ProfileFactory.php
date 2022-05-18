<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Profile>
 */
class ProfileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $name = $this->faker->words(2,true);

        return [
            // 'project_id' не генерим, он обязательно должен быть передан
            'google_id' => $this->faker->numberBetween(1000000000,9999999999),
            'name' => $name,
            'activity' => false,
            'bid' => 0,
            'template' => '123',
            'settings' => '[]',
            'replacement' => '',
            'autoupdates' => ''
        ];
    }

    public function withRandomBid()
    {
        return $this->state(function (array $attributes) {
            return [
                'bid' => rand(0,300),
            ];
        });
    }

}
