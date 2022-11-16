<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => $this->faker->numberBetween(2,51),
            'birth_date' => $this->faker->date('d-m-Y', now()),
            'birth_place' => $this->faker->city(),
        ];
    }
}
