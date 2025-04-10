<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Mail\ConfermaIscrizione;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;


use App\Models\Evento;
use App\Models\Utente;
use App\Models\DataLayer;

class IscrizioneController extends Controller
{


    public function formCaspolata($id)
    {
        $evento = Evento::where('id', $id)->where('tipo', 'Caspolata')->firstOrFail();

        $utente = null;

        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            $utente = Utente::where('user_id', $_SESSION['loggedID'])->first();
        }

        return view('eventi.caspolata.iscrizioneCaspolata', compact('evento', 'utente'));
    }

    public function formRaduno($id)
    {
        $evento = Evento::where('id', $id)->where('tipo', 'Raduno')->firstOrFail();

        $utente = null;

        if (isset($_SESSION['logged']) && $_SESSION['logged']) {
            $utente = Utente::where('user_id', $_SESSION['loggedID'])->first();
        }

        return view('eventi.raduno.iscrizioneRaduno', compact('evento', 'utente'));
    }


    public function submit(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'cognome' => 'required|string|max:255',
            'email' => 'required|email',
            'cellulare' => 'required|string|max:20',
            'via' => 'required|string|max:255',
            'comune' => 'required|string|max:255',
            'provincia' => 'required|string|max:255',
            'nazione' => 'required|string|max:255',
            'evento_id' => 'required|integer|exists:evento,id',
            'ricevuta' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $evento = Evento::findOrFail($request->evento_id);

        // Check o creazione utente
        $utente = Utente::firstOrCreate(
            ['email' => $request->email],
            $request->only('nome', 'cognome', 'cellulare', 'via', 'comune', 'provincia') + ['nazione' => 'Italia']
        );

        // Check doppia iscrizione
        if ($utente->iscrizioni()->where('evento.id', $evento->id)->exists()) {
            return redirect()->back()->withErrors(['msg' => 'Sei già iscritto a questo evento.']);
        }

        // Upload ricevuta
        $path = $request->file('ricevuta')->store('ricevute', 'public');

        // Associa utente all'evento con dati extra nella pivot
        $utente->iscrizioni()->attach($evento->id, [
            'ricevuta' => $path,
            'created_at' => now(), // 👈 AGGIUNGI QUESTO
            'updated_at' => now(),
        ]);

        // Invia email di conferma
        // Mail::to($utente->email)->send(new ConfermaIscrizione($utente, $evento));


        if (strtolower($evento->tipo) === 'raduno') {
            return redirect()->route('raduno.index')->with('success', 'Iscrizione al raduno completata con successo!');
        } elseif (strtolower($evento->tipo) === 'caspolata') {
            return redirect()->route('caspolata.index')->with('success', 'Iscrizione alla caspolata completata con successo!');
        } else {
            return redirect()->route('home')->with('success', 'Iscrizione completata!');
        }
    }

    public function destroy($evento_id)
    {
        $userId = $_SESSION['loggedID'] ?? null;

        if (!$userId) {
            return redirect()->route('user.login')->withErrors(['msg' => 'Devi essere loggato.']);
        }

        DB::table('iscrizione')
            ->where('id_utente', $userId)
            ->where('id_evento', $evento_id)
            ->delete();

        return redirect()->back()->with('success', 'Iscrizione annullata con successo.');
    }



}
