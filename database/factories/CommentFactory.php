<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Comment;
use App\Models\User;
use App\Models\Post;

use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'post_id' => Post::all()->random()->id,
        'comment_body' => $faker->text(),
        'comment_image' => $faker->image(),
    ];
});
