<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Buddy::class, function (Faker $faker) {
    return [
        'id_user' => factory(App\Models\Person::class)->create()->id_user,
    ];
});
