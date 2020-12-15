<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Downvote;
use App\Models\Post;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(Downvote::class, function (Faker $faker) {
    $downvoteable = [
        Post::class, 
        Comment::class,
    ];

    $downvoteableType = $faker->randomElement($downvoteable);
    $downvoteableId = null;
    
    if ($downvoteableType == Post::class) {
        $downvoteableId = Post::all()->random()->id;
    } else {
        $downvoteableId = Comment::all()->random()->id;
    }

    return [
        'downvoteable_id' => $downvoteableId,
        'downvoteable_type' => $downvoteableType,
    ];
});
