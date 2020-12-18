<?php

namespace Database\Factories;

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Illuminate\Support\Str;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(User::class, function (Faker $faker) {
    return [
        'first_name' => $faker->firstName(),
            'last_name' => $faker->lastName(),
            'date_of_birth' => $faker->date(),
            'email' => $faker->unique()->safeEmail,
            'email_verified_at' => now(),
            'password' => Hash::make($faker->password()),
            'profile_image' => $faker->image(),
            'remember_token' => Str::random(10),
    ];
});
