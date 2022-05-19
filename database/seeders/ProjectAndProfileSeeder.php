<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;
use App\Models\Profile;

class ProjectAndProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Projects & Profiles');
        //Projects & profiles
        Project::factory(10)
            ->has(Profile::factory()->count(3)->withRandomBid())
            ->create();

        /* Вариант сида сразу с подключением юзеров
        Project::factory(10)
            ->has(Profile::factory()->count(3)->withRandomBid())
            ->afterCreating(function (Project $project) {
                $project->users()->sync(User::select('id')->inRandomOrder()->limit(3)->get()->pluck('id')->toArray());
            })
            ->create();
        */

    }
}
