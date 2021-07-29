<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

$factory->define(User::class, function (Faker $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        // 'email_verified_at' => now(),
        'password' => $password ?: $password = Hash::make('password'),
        'hash' => Str::random(32),
        'remember_token' => Str::random(10),
    ];
});
