<?php

use App\Models\Comment;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('comments')->insert([
            'user_id' => 1,
            'post_id' => 1,
            'comment_body' => 'example body of comment',
            'comment_image' => 'example_comment_image.jpg'
        ]);

        factory(Comment::class, 100)->create();
    }
}
