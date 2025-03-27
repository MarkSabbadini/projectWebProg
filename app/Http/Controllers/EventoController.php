<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    // Homepage per gli eventi Raduno
    public function radunoIndex()
{
    $eventi = Evento::where('tipo', 'Raduno')->get();
    return view('eventi.raduno.raduno', compact('eventi'));
}

    // Homepage per gli eventi Caspolata
    public function caspolataIndex()
{
    $eventi = Evento::where('tipo', 'Caspolata')->get();
    return view('eventi.caspolata.caspolata', compact('eventi'));
}


    // Form di creazione evento (usato da entrambi i tipi)
    public function create()
    {
        return view('eventi.creaEvento');
    }

    // Inserimento dell'evento nel database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'edizione' => 'required|integer',
            'tipo' => 'required|in:Raduno,Caspolata',
            'descrizione' => 'nullable|string|max:1000',
            'locandina' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        if ($request->hasFile('locandina')) {
            $path = $request->file('locandina')->store('locandine', 'public');
            $validated['locandina'] = $path;
        }

        Evento::create($validated);

        return redirect()->back()->with('success', 'Evento inserito con successo!');
    }

    // Pagina iscrizione singola a raduno
    public function iscrizioneRaduno()
    {
        return view('eventi.raduno.iscrizioneRaduno');
    }

    // Pagina iscrizione a caspolata
    public function iscrizioneCaspolata()
    {
        return view('eventi.caspolata.iscrizioneCaspolata');
    }
} 
