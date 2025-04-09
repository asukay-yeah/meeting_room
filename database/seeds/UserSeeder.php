<?php

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
        DB::table('users')->insert([
            [
                'name' => 'Admin',
                'email' => 'admin',
                'role' => 'admin',
                'password' => bcrypt('123456')
            ],
            [
                'name' => 'User',
                'email' => 'user',
                'role' => 'user',
                'password' => bcrypt('123456')
            ],
        ]);
    }
}