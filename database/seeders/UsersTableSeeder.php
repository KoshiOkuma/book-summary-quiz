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
                'name' => 'test',
                'email' => 'test@test.com',
                'avator' => '',
                'password' => Hash::make('password'),
            ],
            [
                'name' => 'koshi',
                'email' => 'test2@test.com',
                'avator' => '',
                'password' => Hash::make('password'),
            ],
        ]);
    }
}
