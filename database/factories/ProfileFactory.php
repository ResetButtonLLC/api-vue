<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;

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

        $name = $this->faker->domainName();

        return [
            // 'client_id' не генерим, он обязательно должен быть передан
            //'google_id' => $this->faker->numerify('###-###-####'),
            'google_id' => $this->faker->numerify('##########'),
            'db' =>  $name,
            'name' => $name,
            'template' => '123',
            'settings' => '[]',
            'replacement' => '',
            'autoupdates' => ''
        ];
    }
}
