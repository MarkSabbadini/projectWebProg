<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Utente;
use App\Models\Evento;
use Illuminate\Database\Seeder;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        
        $this->populateDB();
        // $this->createUsers();

    }

    private function populateDB() {

        $utenti = Utente::factory()->count(10)->create();
       
        // Creiamo 5 eventi 
        Evento::factory()->count(5)->create()->each(function ($evento) use ($utenti) {
            
            // Prendo insieme casuale di utenti 
            $randomUtenti = $utenti->random(rand(1,4));
            $evento->iscritti()->attach($randomUtenti);

        });
    }
}
