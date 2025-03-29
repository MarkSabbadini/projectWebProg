<?php

namespace App\Models;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;



class DataLayer
{

    // Ritorna lista eventi
    public function listEventi()
    {
        $eventi =  Evento::orderBy('created_at', 'desc')->get();

        return $eventi;
    }

    // Lista eventi per tipo
    public function listEventiByTipo($tipo)
    {
        $eventi_per_tipo =  Evento::where('tipo', $tipo)->orderBy('created_at', 'desc')->get();

        return $eventi_per_tipo;
    }

    // Ricerca evento per id
    public function findEventoById($id)
    {
        return Evento::find($id);
    }

    // Inserimento nuovo evento
    public function addEvento($nome, $edizione, $tipo, $descrizione, $locandina)
    {
        $evento = new Evento;

        $evento->nome = $nome;
        $evento->edizione = $edizione;
        $evento->tipo = $tipo;
        $evento->descrizione = $descrizione;
        $evento->locandina = $locandina;

        $evento->save();
    }
    
    // Modifica evento esistente
    public function editEvento($id, $nome, $edizione, $tipo, $descrizione, $locandina)
    {
        $evento = Evento::find($id);

        if (!$evento)
            return null;

        $evento->nome = $nome;
        $evento->edizione = $edizione;
        $evento->tipo = $tipo;
        $evento->descrizione = $descrizione;

        if ($locandina != null) {

            $attualeLocandina = $evento->locandina;
            // Rimuovi locandina precedente se presente
            if ($evento->locandina && Storage::disk('public')->exists($evento->$attualeLocandina)) {
                Storage::disk('public')->delete($evento->attualeLocandina);
            }

            $evento->locandina = $locandina;
        }

        $evento->save();
    }

    // Eliminazione evento
    public function deleteEvento($id)
    {
        $evento = Evento::find($id);

        if ($evento) {
            // Rimuovi la locandina dallo storage
            if ($evento->locandina && Storage::disk('public')->exists($evento->locandina)) {
                Storage::disk('public')->delete($evento->locandina);
            }

            $evento->delete();
        }
    }

    // Verifica duplicati (nome + edizione)
    public function eventoExists($nome, $edizione)
    {
        return Evento::where('nome', $nome)
            ->where('edizione', $edizione)
            ->exists();
    }

    // Recupera iscritti per un evento
    public function getIscrittiEvento($eventoId)
    {
        $evento = Evento::find($eventoId);
        return $evento ? $evento->iscritti : null;
    }



    public function listUtenti()
    {
        return Utente::orderBy('cognome', 'asc')->orderBy('nome', 'asc')->get();
    }

    public function findUtenteById($id)
    {
        return Utente::find($id);
    }

    public function findUtenteByEmail($email)
    {
        return Utente::where('email', $email)->first();
    }

    public function addUtente($nome, $cognome, $email, $cellulare, $via, $comune, $provincia, $nazione)
    {
        $utente = new Utente();
        $utente->nome = $nome;
        $utente->cognome = $cognome;
        $utente->email = $email;
        $utente->cellulare = $cellulare;
        $utente->via = $via;
        $utente->comune = $comune;
        $utente->provincia = $provincia;
        $utente->nazione = $nazione;

        $utente->save();

        return $utente;
    }

    public function editUtente($id, $dati)
    {
        $utente = Utente::find($id);

        if ($utente) {
            $utente->update($dati);
        }

        return $utente;
    }

    public function deleteUtente($id)
    {
        $utente = Utente::find($id);

        if ($utente) {
            // Se ci sono iscrizioni, potresti decidere se cancellarle oppure no
            $utente->iscrizioni()->detach();
            $utente->delete();
        }
    }


}
