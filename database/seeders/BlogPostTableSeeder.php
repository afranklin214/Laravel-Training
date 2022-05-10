<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\BlogPost;

class BlogPostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all();
        
        BlogPost::factory(50)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });
    }
}
