<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use App\Models\Utente;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;

class UtenteController extends Controller
{
    public function index()
    {

        if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
            return redirect()->route('user.login')->with('error', 'Devi essere loggato per accedere al profilo!');
        }

        $utente = Utente::where('user_id', $_SESSION['loggedID'])->first();

        return view('utente.profilo')->with('utente', $utente);
    }

    public function edit()
    {

        $utente = Utente::where('user_id', $_SESSION['loggedID'])->first();

        if (!$utente) {
            return redirect()->route('profilo.create');
        }

        return view('utente.editProfilo', compact('utente'));
    }

    public function create()
    {

        return view('utente.creaProfilo');
    }

    public function store(Request $request)
    {

        $utente = new Utente();
        $utente->user_id = $_SESSION['loggedID'];
        $utente->nome = $_SESSION['loggedName'];
        $utente->email = User::find($_SESSION['loggedID'])->email;
        $utente->cognome = $request->input('cognome');
        $utente->cellulare = $request->input('cellulare');
        $utente->via = $request->input('via');
        $utente->comune = $request->input('comune');
        $utente->provincia = $request->input('provincia');
        $utente->nazione = $request->input('nazione');
        $utente->save();

        return redirect()->route('profilo')->with('success', 'Profilo creato!');
    }

    public function update(Request $request)
    {

        $utente = Utente::where('user_id', $_SESSION['loggedID'])->first();

        if ($utente) {
            $utente->update($request->only([
                'cognome',
                'cellulare',
                'via',
                'comune',
                'provincia',
                'nazione'
            ]));
        }

        return redirect()->route('profilo')->with('success', 'Profilo aggiornato!');
    }

    public function mieIscrizioni()
    {
        $userId = $_SESSION['loggedID'] ?? null;

        if (!$userId) {
            return redirect()->route('user.login')->withErrors(['msg' => 'Devi essere loggato.']);
        }

        $utente = Utente::where('user_id', $userId)->first();

        if (!$utente) {
            return redirect()->route('profilo.create')->withErrors(['msg' => 'Crea prima un profilo.']);
        }

        $iscrizioni = $utente->iscrizioni()->withPivot('ricevuta', 'created_at')->get();

        return view('utente.mieIscrizioni', compact('iscrizioni'));
    }

}
