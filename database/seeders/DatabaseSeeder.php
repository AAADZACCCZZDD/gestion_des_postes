<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        if($this->command->confirm('do u want to refresh the database ??')){
            $this->command->call('migrate:fresh');
            $this->command->info('db was refreshed');
        }
        
         $this->call([
            UserTableSeeder::class,
            PostTableSeeder::class,
            CommentTableSeeder::class,
            TagTableSeeder::class,
         ]);
    }
}
