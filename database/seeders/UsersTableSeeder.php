<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
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
                'name' => 'guest',
                'email' => 'test@test.com',
                'avatar' => 'public/images/no_image.jpg',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'koshi',
                'email' => 'test2@test.com',
                'avatar' => '',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
