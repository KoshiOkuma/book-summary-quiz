<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChoicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('choices')->insert([
            [
                'question_id' => 1,
                'content' => "富士山",
                'is_answer' => 1,
            ],
            [
                'question_id' => 1,
                'content' => "阿蘇山",
                'is_answer' => 0,
            ],
            [
                'question_id' => 1,
                'content' => "北岳",
                'is_answer' => 0,
            ]
        ]);
    }
}
