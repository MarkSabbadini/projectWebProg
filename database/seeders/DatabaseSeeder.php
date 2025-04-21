<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Utente;
use App\Models\Evento;
use App\Models\Squadra;
use App\Models\Calciatore;
use App\Models\Partita;
use App\Models\Goal;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->createUsers();
        $this->populateDB();
    }

    private function createUsers()
    {
        // Utenti specifici (admin e due utenti)
        $users = collect([
            User::factory()->create([
                'name' => 'Marco Sabbadini',
                'email' => 'marco.sabbadini@unibs.it',
                'password' => Hash::make('marco'),
                'role' => 'admin'
            ]),
            User::factory()->create([
                'name' => 'Paolo Sabbadini',
                'email' => 'paolo.sabbadini@unibs.it',
                'password' => Hash::make('paolo'),
                'role' => 'registered_user'
            ]),
            User::factory()->create([
                'name' => 'Mark Sabbadini',
                'email' => 'mark.sabbadini@unibs.it',
                'password' => Hash::make('mark'),
                'role' => 'registered_user'
            ]),
        ]);

        // Aggiungiamo altri 7 utenti + profili
        for ($i = 0; $i < 7; $i++) {
            $users->push(User::factory()->create());
        }

        // Per ogni utente crea profilo "Utente"
        $users->each(function ($user) {
            Utente::factory()->create([
                'user_id' => $user->id,
                'nome' => $user->name,
                'email' => $user->email,
            ]);
        });
    }

    private function populateDB()
    {
        $utenti = Utente::all();
        $registeredUsers = Utente::whereHas('user', function ($query) {
            $query->where('role', 'registered_user');
        })->take(2)->get();

        // Date helpers
        $oggi = now();
        $futureDates = collect(range(1, 4))->map(fn($i) => $oggi->copy()->addDays($i * 5));
        $pastDates = collect(range(1, 6))->map(fn($i) => $oggi->copy()->subDays($i * 5));

        // Crea 4 eventi futuri
        foreach ($futureDates as $data) {
            Evento::factory()->create([
                'data' => $data,
                'tipo' => fake()->randomElement(['raduno', 'caspolata']),
            ]);
        }

        // Crea 3 eventi passati con i due registered_user iscritti
        foreach ($pastDates->take(3) as $data) {
            $evento = Evento::factory()->create([
                'data' => $data,
                'tipo' => fake()->randomElement(['raduno', 'caspolata']),
            ]);

            $evento->iscritti()->attach($registeredUsers->pluck('id'), [
                'ricevuta' => 'ricevute/ricevuta_partecipato.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Crea 3 eventi passati a cui nessun registered_user ha partecipato
        foreach ($pastDates->slice(3) as $data) {
            $evento = Evento::factory()->create([
                'data' => $data,
                'tipo' => fake()->randomElement(['raduno', 'caspolata']),
            ]);

            // iscrive utenti casuali, ma NON i due registered_user
            $altriUtenti = $utenti->whereNotIn('id', $registeredUsers->pluck('id'))->random(rand(1, 4));
            $evento->iscritti()->attach($altriUtenti->pluck('id'), [
                'ricevuta' => 'ricevute/ricevuta_altro.pdf',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Crea 4 squadre
        $squadre = Squadra::factory()->count(4)->create();

        // Per ogni squadra crea da 5 a 11 calciatori
        $squadre->each(function ($squadra) {
            Calciatore::factory()
                ->count(rand(5, 11))
                ->create(['nome_squadra' => $squadra->nome]);
        });

        // Crea 3 partite con squadre casuali
        $squadreIds = $squadre->pluck('id')->toArray();

        for ($i = 0; $i < 3; $i++) {
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

}
