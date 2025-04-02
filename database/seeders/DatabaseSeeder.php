<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Utente;
use App\Models\Evento;
use App\Models\Squadra;
use App\Models\Calciatore;
use App\Models\Partita;
use App\Models\Goal;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->populateDB();
        $this->createUsers();

    }

    private function populateDB()
    {

        $utenti = Utente::factory()->count(10)->create();

        // Creiamo 5 eventi 
        Evento::factory()->count(5)->create()->each(function ($evento) use ($utenti) {

            // Prendo insieme casuale di utenti 
            $randomUtenti = $utenti->random(rand(1, 4));
            $evento->iscritti()->attach($randomUtenti);

        });

        // 3. Crea 4 squadre
        $squadre = Squadra::factory()->count(4)->create();

        // 4. Per ogni squadra crea da 5 a 11 calciatori
        $squadre->each(function ($squadra) {
            Calciatore::factory()
                ->count(rand(9, 15))
                ->create(['nome_squadra' => $squadra->nome]);
        });

        // 5. Crea 3 partite con squadre casuali diverse
        $squadreIds = $squadre->pluck('id')->toArray();

        for ($i = 0; $i < 3; $i++) {

            // Prendi due squadre diverse casuali
            $home = $squadreIds[array_rand($squadreIds)];

            do {
                $away = $squadreIds[array_rand($squadreIds)];
            } while ($away === $home);

            $partita = Partita::create([
                'id_squadra_home' => $home,
                'id_squadra_away' => $away,
                'goal_home' => rand(0, 5),
                'goal_away' => rand(0, 5),
                'data' => now()->addDays(rand(1, 30)),
            ]);

            // 6. Prendi alcuni calciatori a caso per assegnare goal
            $calciatori = Calciatore::inRandomOrder()->limit(rand(2, 6))->get();

            foreach ($calciatori as $index => $calciatore) {
                Goal::create([
                    'id_marcatore' => $calciatore->id,
                    'id_partita' => $partita->id,
                    'numero' => $index + 1,
                ]);
            }
        }
    }

    private function createUsers()
    {

        User::factory()->create([
            'name' => 'Marco Sabbadini',
            'email' => 'marco.sabbadini@unibs.it',
            'password' => 'marco',
            'role' => 'admin'

        ]);

        User::factory()->create([
            'name' => 'Paolo Sabbadini',
            'email' => 'paolo.sabbadini@unibs.it',
            'password' => 'paolo',
            'role' => 'registered_user'
        ]);

        User::factory()->create([
            'name' => 'Mark Sabbadini',
            'email' => 'mark.sabbadiniini@unibs.it',
            'password' => 'mark',
            'role' => 'registered_user'
        ]);
    }
}