<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'hash' => str_random(32),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Models\Person::class, function (Faker\Generator $faker) {
    return [
        'id_user' => function() {
            return factory(App\Models\User::class)->create()->id_user;
        },
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'sex' => 'M',
    ];
});

$factory->define(App\Models\ExchangeStudent::class, function (Faker\Generator $faker) {
    return [
        'id_user' => function() {
            return factory(App\Models\Person::class)->create()->id_user;
        },
        'id_country' => $faker->numberBetween(1, 50),
        'id_accommodation' => $faker->numberBetween(1, 10),
        'id_faculty' => $faker->numberBetween(1, 7),
    ];
});

$factory->define(\App\Models\Buddy::class, function (Faker\Generator $faker) {
   return [
       'id_user' => function() {
            return factory(App\Models\Person::class)->create()->id_user;
        },
   ];
});

