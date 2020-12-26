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
            'post_title' => 'Call Of Duty Is Amazing!',
            'post_body' => 'Warzone has saved the franchise'
        ]);

        $post->tags()->attach(1);

        factory(Post::class, 50)->create();

    }
}
