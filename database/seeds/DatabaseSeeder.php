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
        ]);
//        $this->call(UsersTableSeeder::class);
    }
}
