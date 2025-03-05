<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{

     protected $model = Evento::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->firstName(),
            'cognome' => $this->faker->lastName(), 
            'descrizione' => $this->faker->sentence(1,5),
            'locandina' =>  $this->faker->url()             // ATTENZIONE! SISTEMARE DISCORSO LOCANDINA
        ];
    }
}
