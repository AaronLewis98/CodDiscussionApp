<?php

use App\Models\Post;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $post = Post::create([
            'user_id' => 1,
            'post_title' => 'example title',
            'post_body' => 'example body of post',
            'post_image' => 'example_post_image.jpg'
        ]);

        $post->tags()->attach(1);

        factory(Post::class, 50)->create();

    }
}
