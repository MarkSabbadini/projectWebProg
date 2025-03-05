<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Utente;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Utente>
 */
class UtenteFactory extends Factory
{
   
    protected $model = Evento::class;

    public function definition(): array
    {
        return [
            'nome' => $this->faker->firstName(),
            'cognome' => $this->faker->lastName(),
            'cellulare' => $this->faker->phoneNumber(),
            'email' => $this->faker->safeEmail(),
            'via' => $this->faker->streetName(),
            'civico' => $this->faker->streetAddress(),
            'comune' => $this->faker->city(),
            'provincia' => $this->faker->state,
            'nazione' => $this->faker->countryCode()
        ];
    }
}
