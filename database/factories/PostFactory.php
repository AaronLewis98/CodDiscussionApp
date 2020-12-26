<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker) {
    return [
        'user_id' => User::all()->random()->id,
        'post_title' => $faker->text(10),
        'post_body' => $faker->text()
    ];
});
