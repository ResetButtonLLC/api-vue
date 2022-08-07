<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->command->info('Creating Admin and non-privileged users');

        $testUser = User::factory([
            'name' => 'Test',
            'email' => 'test@test',
            'avatar' => '/img/test.png',
            'role' => USER::ROLE_ADMIN
        ])->make();

        User::firstOrCreate(
            ['email' => 'test@test'],
            $testUser->toArray()
        );

        User::factory(20)->create();
    }
}
