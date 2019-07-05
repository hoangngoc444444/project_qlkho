<?php

use Illuminate\Database\Seeder;
use App\User;
class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
            'remember_token' => str_random(10),
            'roles' => 1,
            'email_verified_at' => now(),
        ]);
    }
}
