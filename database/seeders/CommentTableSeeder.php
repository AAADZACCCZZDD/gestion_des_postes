<?php

namespace Database\Seeders;

use Carbon\Factory;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
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
        $users = User::all();
        if ($posts->count() == 0) {
            $this->command->info('u cant generate any Comment');
            return;
        }
        $nb_comments = (int)$this->command->ask('how many comments u want to generate');
        Comment::Factory($nb_comments)->make()->each(function($comment) use ($posts, $users){
            $comment->post_id= $posts->random()->id;
            $comment->user_id= $users->random()->id;
            $comment->save();
        });
    }
}
