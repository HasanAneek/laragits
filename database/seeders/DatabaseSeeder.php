<?php

namespace Database\Seeders;

use App\Models\Post;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use \App\Models\User;
use Database\Factories\PostFactory;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
//        User::factory(5)->create();
//        Post::factory(6)->create();


        $user = User::factory()->create([
           'name' => 'John Doe',
           'email' => 'john@doe.com'
        ]);

        Post::factory(8)->create([
          'user_id' => $user->id
        ]);
    }
}
