<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Buddy;
use App\Models\Person;
use Faker\Generator as Faker;

$factory->define(Buddy::class, function (Faker $faker) {
    return [
        'id_user' => factory(Person::class)->create()->id_user,
    ];
});
