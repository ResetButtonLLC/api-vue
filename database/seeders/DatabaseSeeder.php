<?php

namespace Database\Seeders;

use App\Models\{Client, Profile, User};
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

        User::factory([
            'name' => 'Test',
            'email' => 'test@test',
            'avatar' => '/img/test.png',
            'role' => USER::ROLE_ADMIN
        ])->create();

        User::factory(20)->create();
        Client::factory(10)
            ->has(Profile::factory()->count(3))
            ->afterCreating(function (Client $client) {
                $client->users()->sync(User::select('id')->inRandomOrder()->limit(3)->get()->pluck('id')->toArray());
            })
            ->create();
    }
}
