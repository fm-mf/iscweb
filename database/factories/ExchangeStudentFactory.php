<?php

namespace Database\Factories;

use App\Models\Person;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExchangeStudentFactory extends Factory
{
    public function definition()
    {
        return [
            'id_user' => Person::factory()->create()->id_user,
            'id_country' => $this->faker->numberBetween(1, 50),
            'id_accommodation' => $this->faker->numberBetween(1, 10),
            'id_faculty' => $this->faker->numberBetween(1, 7),
            'about' => $this->faker->sentence,
        ];
    }
}
