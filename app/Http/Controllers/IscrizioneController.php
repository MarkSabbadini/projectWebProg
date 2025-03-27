<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Evento;
use App\Models\Utente;

class IscrizioneController extends Controller
{
    public function formRaduno($id)
    {
        $evento = Evento::where('id', $id)->where('tipo', 'Raduno')->firstOrFail();
        return view('eventi.raduno.iscrizioneRaduno', compact('evento'));
    }

    public function formCaspolata($id)
    {
        $evento = Evento::where('id', $id)->where('tipo', 'Caspolata')->firstOrFail();
        return view('eventi.caspolata.iscrizioneCaspolata', compact('evento'));
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
        ]);
    
        return redirect()->back()->with('success', 'Iscrizione completata con successo!');
    }
    

}
