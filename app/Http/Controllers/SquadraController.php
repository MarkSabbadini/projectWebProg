<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Squadra;

class SquadraController extends Controller
{
    /**
     * Mostra l'elenco delle squadre con la loro rosa.
     */
    
    public function index()
    {
        // Recupera tutte le squadre con i relativi calciatori
        $squadre = Squadra::with('calciatori')->get();

        return view('calcio.squadre', compact('squadre'));
    }
}

