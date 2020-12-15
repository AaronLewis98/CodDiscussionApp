<?php

use App\Models\Comment;
use App\Models\Downvote;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DownvoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('downvotes')->insert([
            'downvoteable_id' => Comment::all()->random()->id,
            'downvoteable_type' => Comment::class
        ]);

        factory(Downvote::class, 50)->create();
    }
}
