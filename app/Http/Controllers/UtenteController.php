<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UtenteController extends Controller
{
    public function profilo()
    {
        $utente = auth()->user();
        return view('utente.profilo', compact('utente'));
    }

    public function mieIscrizioni()
    {
        $utente = auth()->user();
        $iscrizioni = $utente->iscrizioni ?? []; // Assicurati che esista la relazione
        return view('utente.iscrizioni', compact('iscrizioni'));
    }
}
