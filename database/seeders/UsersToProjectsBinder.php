<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\User;

class UsersToProjectsBinder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Bind users to projects');
        foreach (Project::all() as $project) {
            $users = User::select('id')->inRandomOrder()->limit(3)->get()->pluck('id')->toArray();
            $project->users()->sync($users);
        }
    }
}
