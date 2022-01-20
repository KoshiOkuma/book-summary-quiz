<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
            'book_id' => 1,
            'content' => "日本一高い山は何",
            'description' => "標高は3776m",
            ]
        ]);

    }
}
