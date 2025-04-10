<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;




class DataLayer
{

    // Ritorna lista eventi
    public function listRaduni()
    {
        $raduni = Evento::where('tipo', 'raduno')
            ->orderBy('created_at', 'desc')
            ->get();

        return $raduni;
    }

    public function listCaspolate()
    {
        $caspolate = Evento::where('tipo', 'caspolata')
            ->orderBy('created_at', 'desc')
            ->get();

        return $caspolate;
    }



    // Ricerca evento per id
    public function findEventoById($id)
    {
        return Evento::find($id);
    }

    // Inserimento nuovo evento
    public function addEvento($nome, $data, $tipo, $descrizione, $locandina)
    {
        $evento = new Evento;

        $evento->nome = $nome;
        $evento->data = $data;
        $evento->tipo = $tipo;
        $evento->descrizione = $descrizione;
        $evento->locandina_path = $locandina;

        $evento->save();
    }


    // Eliminazione evento
    public function deleteEvento($id)
    {
        $evento = Evento::find($id);

        if ($evento) {
            if ($evento->locandina_path && Storage::disk('public')->exists($evento->locandina_path)) {
                Storage::disk('public')->delete($evento->locandina_path);
            }

            $evento->delete();
        }


    }

    public function updateEvento($id, $nome, $data, $tipo, $descrizione, $locandina = null)
    {
        $evento = Evento::find($id);

        if ($evento) {
            $evento->nome = $nome;
            $evento->data = $data;
            $evento->tipo = $tipo;
            $evento->descrizione = $descrizione;

            if ($locandina) {
                // Rimuovi la vecchia locandina se esiste
                if ($evento->locandina_path && Storage::disk('public')->exists($evento->locandina_path)) {
                    Storage::disk('public')->delete($evento->locandina_path);
                }

                $evento->locandina_path = $locandina;
            }

            $evento->save();
        }
    }

    // Verifica duplicati (nome + edizione)
    public function eventoExists($nome, $data)
    {
        return Evento::where('nome', $nome)
            ->where('data', $data)
            ->exists();
    }

    // Recupera iscritti per un evento
    public function getIscrittiEvento($eventoId)
    {
        $evento = Evento::find($eventoId);
        return $evento ? $evento->iscritti : null;
    }

    public function validUser($email, $password)
    {
        $user = User::where('email', $email)->first();

        if ($user && Hash::check($password, $user->password)) {
            return true;
        } else {
            return false;
        }
    }

    public function addUser($name, $password, $email)
    {
        $user = new User();
        $user->name = $name;
        $user->password = Hash::make($password);
        $user->email = $email;
        $user->role = "registered_user";
        $user->email_verified_at = now();
        $user->save();

        return $user; // Ritorno user per compilazione
    }

    public function getUserById($id)
    {
        return User::find($id);
    }


    public function getUserID($email)
    {
        $users = User::where('email', $email)->get(['id']);
        return $users[0]->id;
    }

    public function getUserName($email)
    {
        $users = User::where('email', $email)->get(['name']);
        return $users[0]->name;
    }

    public function getUserRole($email)
    {
        $users = User::where('email', $email)->get(['role']);
        return $users[0]->role;
    }

    public function getEventiIscrittiUtente($userId)
    {
        return DB::table('iscrizione')
            ->where('id_utente', $userId)
            ->pluck('id_evento')   // restituisce solo l'elenco degli ID evento
            ->toArray();
    }


    public function findUserByemail($email)
    {

        $users = User::where('email', $email)->get();

        if (count($users) == 0) {
            return false;
        } else {
            return true;
        }
    }

    public function eventoInData($data)
    {
        return Evento::whereDate('data', $data)->exists();
    }


}
