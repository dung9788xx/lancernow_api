<?php

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
        \App\User::forceCreate([
            'name' => 'admin',
            'email' =>'admin@gmail.com',
            'password' => Hash::make('password'),
            'role' => \App\Enum\UserRole::ADMIN
        ]);
        \App\User::forceCreate([
            'name' => 'admin',
            'email' =>'hirer@gmail.com',
            'password' => Hash::make('hirer'),
            'role' => \App\Enum\UserRole::HIRER
        ]);
        \App\User::forceCreate([
            'name' => 'admin',
            'email' =>'lancer@gmail.com',
            'password' => Hash::make('lancer'),
            'role' => \App\Enum\UserRole::LANCER
        ]);
//        $this->call(UsersTableSeeder::class);
    }
}
