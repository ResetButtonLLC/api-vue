<?php

namespace Database\Seeders;

use App\Models\{Project, Profile, User};
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

        $user = User::factory([
            'name' => 'Test',
            'email' => 'test@test',
            'avatar' => '/img/test.png',
            'role' => USER::ROLE_ADMIN
        ])->make();

        User::firstOrCreate(
            ['email' => 'test@test'],
            $user->toArray()
        );

        User::factory(20)->create();
        Project::factory(10)
            ->has(Profile::factory()->count(3))
            ->afterCreating(function (Project $project) {
                $project->users()->sync(User::select('id')->inRandomOrder()->limit(3)->get()->pluck('id')->toArray());
            })
            ->create();
    }
}
