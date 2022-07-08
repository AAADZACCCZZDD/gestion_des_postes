<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\Post;
use Carbon\Factory;
use Illuminate\Database\Seeder;

class CommentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = Post::all();
        if ($posts->count() == 0) {
            $this->command->info('u cant generate any Comment');
            return;
        }
        $nb_comments = (int)$this->command->ask('how many comments u want to generate');
        Comment::Factory($nb_comments)->make()->each(function($comment) use ($posts){
            $comment->post_id= $posts->random()->id;
            $comment->save();
        });
    }
}
