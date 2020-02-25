<?php

use Faker\Generator as Faker;

$factory->define(App\Models\ExchangeStudent::class, function (Faker $faker) {
    return [
        'id_user' => factory(App\Models\Person::class)->create()->id_user,
        'id_country' => $faker->numberBetween(1, 50),
        'id_accommodation' => $faker->numberBetween(1, 10),
        'id_faculty' => $faker->numberBetween(1, 7),
        'about' => $faker->sentence,
    ];
});
