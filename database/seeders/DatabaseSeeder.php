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
        $else = \App\Models\User::factory(20)->create();
        $doe = \App\Models\User::factory()->john_doe()->create();

        $users = $else->concat([$doe]);

        $posts = \App\Models\BlogPost::factory(50)->make()->each(function($post) use ($users) {
            $post->user_id = $users->random()->id;
            $post->save();
        });

        $comments = \App\Models\Comment::factory(150)->make()->each(function($comment) use ($posts) {
            $comment->blog_post_id = $posts->random()->id;
            $comment->save();
        });
    }
}
