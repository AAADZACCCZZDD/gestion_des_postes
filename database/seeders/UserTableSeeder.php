<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $nb_users = (int)$this->command->ask('how many users u want to generate');
        User::factory($nb_users)->create();
    }
}
