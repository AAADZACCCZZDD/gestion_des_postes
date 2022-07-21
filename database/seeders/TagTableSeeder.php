<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();

        $tags = collect(['php', 'laravel', 'js', 'html', 'jquery', 'bootstrap', 'java']);

        $tags->each(function ($tag) {
            $mytag = new Tag();
            $mytag->name = $tag;
            $mytag->save();
        });

        // $N_tags = (int)$this->command->ask('how many tags u want to generate ?');
        // Tag::factory($N_tags)->make()->each(function($tag) use ($posts){
        //     $tag->id = $posts->random()->id;
        // });

    }
}
