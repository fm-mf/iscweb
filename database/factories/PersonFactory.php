<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Person::class, function (Faker $faker) {
    return [
        'id_user' => factory(App\Models\User::class)->create()->id_user,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'sex' => 'M',
    ];
});
