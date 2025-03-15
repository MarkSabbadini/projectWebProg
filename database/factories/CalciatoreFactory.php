<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Calciatore>
 */
class CalciatoreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nome_squadra' => $this->faker->firstName(), 
            'nome' => $this->faker->firstName(),
            'cognome' => $this->faker->firstName(),
            'numero' =>  $this->faker->randomNumber(),
            'ruolo' => $this->faker->titleMale()
        ];
    }
}
