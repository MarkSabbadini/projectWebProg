<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Evento;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Evento>
 */
class EventoFactory extends Factory
{   protected $model = Evento::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'nome' => $this->faker->firstName(), 
            'descrizione' => $this->faker->sentence(1,5),
            'data' => $this->faker->date(),
            'tipo' => $this->faker->randomElement(['Raduno', 'Caspolata']),
            'locandina_path' =>  $this->faker->url()  
        ];
    }
}
