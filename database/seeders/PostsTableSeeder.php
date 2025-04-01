<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('posts')->insert([
            ['user_id'=>'1',
            'post'=>'Atlasone初めての投稿です。'],
            ['user_id'=>'2',
            'post'=>'Atlastwo初めての投稿です。'],
            ['user_id'=>'3',
            'post'=>'Atlasthree初めての投稿です。']
        ]);
    }
}
