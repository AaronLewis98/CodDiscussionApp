<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Post;
use App\Models\Upvote;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(Upvote::class, function (Faker $faker) {
    $upvoteable = [
        Post::class, 
        Comment::class,
    ];

    $upvoteableType = $faker->randomElement($upvoteable);
    $upvoteableId = null;
    
    if ($upvoteableType == Post::class) {
        $upvoteableId = Post::all()->random()->id;
    } else {
        $upvoteableId = Comment::all()->random()->id;
    }

    return [
        'upvoteable_id' => $upvoteableId,
        'upvoteable_type' => $upvoteableType,
    ];
});
