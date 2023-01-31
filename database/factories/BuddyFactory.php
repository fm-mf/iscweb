<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class BuddyFactory extends Factory
{
    public function definition()
    {
        return [
            'id_user' => Person::factory()->create()->id_user,
        ];
    }
}
