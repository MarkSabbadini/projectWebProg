<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Recensione;
use App\Models\Evento;
use App\Models\Utente;


class RecensioneController extends Controller
{
    public function store(Request $request)
{
    if (!isset($_SESSION['loggedID'])) {
        abort(403, 'Utente non autenticato.');
    }

    $request->validate([
        'id_evento' => 'required|exists:evento,id',
        'commento' => 'required|string|max:1000',
        'voto' => 'required|integer|min:1|max:5',
    ]);

    // Creo la recensione
    Recensione::create([
        'id_evento' => $request->id_evento,
        'id_utente' => $_SESSION['loggedID'],
        'commento' => $request->commento,
        'voto' => $request->voto,
    ]);

    
    $evento = Evento::findOrFail($request->id_evento);

    if ($evento->tipo === 'caspolata') {
        return redirect()->route('caspolata.index')->with('success', 'Recensione inserita con successo!');
    } elseif ($evento->tipo === 'raduno') {
        return redirect()->route('raduno.index')->with('success', 'Recensione inserita con successo!');
    }

    return redirect()->route('home')->with('success', 'Recensione inserita con successo!');
}



    public function create($id)
    {

        // Verifica se l'utente è loggato
        if (!isset($_SESSION['loggedID'])) {
            abort(403, 'Devi essere autenticato per lasciare una recensione.');
        }

        // Recupera l'utente e l'evento
        $utente = Utente::findOrFail($_SESSION['loggedID']);
        $evento = Evento::with('recensioni')->findOrFail($id);
        $oggi = now();

        // Controlla se l'utente è iscritto all'evento
        $isIscritto = $utente->iscrizioni->contains($evento->id);

        if (!$isIscritto || $evento->data > $oggi) {
            abort(403, 'Non puoi recensire questo evento.');
        }

        return view('eventi.creaRecensione', compact('utente', 'evento'));
    }




    //Mostra tutte le recensioni di un evento

    public function indexPerEvento($id)
    {
        $evento = Evento::with(['recensioni.utente'])->findOrFail($id);
        return view('admin.recensioni_evento', compact('evento'));
    }

    public function indexTuttiEventiPassati()
    {
        $oggi = now();

        $caspolate = Evento::where('tipo', 'caspolata')
            ->where('data', '<', $oggi)
            ->with('recensioni')
            ->get();

        $raduni = Evento::where('tipo', 'raduno')
            ->where('data', '<', $oggi)
            ->with('recensioni')
            ->get();

        return view('eventi.recensioni', compact('caspolate', 'raduni'));
    }

    public function dettaglioEvento($id)
    {
        $evento = Evento::with(['recensioni.utente'])->findOrFail($id);

        return view('eventi.recensioneEvento', compact('evento'));
    }



}

