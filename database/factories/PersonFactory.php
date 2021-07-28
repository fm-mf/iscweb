<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Person;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Person::class, function (Faker $faker) {
    return [
        'id_user' => factory(User::class)->create()->id_user,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'sex' => 'M',
    ];
});
