<?php

use App\Models\Post;
use App\Models\Upvote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UpvoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('upvotes')->insert([
            'upvoteable_id' => Post::all()->random()->id,
            'upvoteable_type' => Post::class
        ]);

        factory(Upvote::class, 50)->create();
    }
}
