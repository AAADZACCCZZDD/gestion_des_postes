<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Seeder;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        if ($users->count() == 0) {
            $this->command->info('u cant generate any post');
            return;
        }
        
        $nb_posts = (int)$this->command->ask('how many posts u want to generate');
        Post::factory($nb_posts)->make()->each(function ($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
