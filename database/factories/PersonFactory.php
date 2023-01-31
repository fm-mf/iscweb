<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class PersonFactory extends Factory
{
    public function definition()
    {
        return [
            'id_user' => User::factory()->create()->id_user,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'sex' => 'M',
        ];
    }
}
