<?php

namespace Database\Seeders;

use App\Models\Tag;
use App\Models\Post;
use Illuminate\Database\Seeder;

class PostTagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $tags_count = Tag::all()->count();
        $tags_count = Tag::count();

        $posts = Post::all();

        $posts->each(function($post) use ($tags_count){
            $take = random_int(1, $tags_count);
            $tags_id = Tag::inRandomOrder()->take($take)->get()->pluck('id');
            $post->tag()->sync($tags_id);
        });

    }
}
