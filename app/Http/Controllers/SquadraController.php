<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Squadra;
use App\Models\DataLayer;

class SquadraController extends Controller
{
    /**
     * Mostra l'elenco delle squadre con la loro rosa.
     */

    public function index()
    {
        session_start();
        // Recupera tutte le squadre con i relativi calciatori
        $squadre = Squadra::with('calciatori')->get();

        return view('calcio.squadre', compact('squadre'));
    }

    public function create()
    {
        return view('calcio.creaSquadra');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_squadra' => 'required|string|max:255',
            'calciatori.*.nome' => 'required|string',
            'calciatori.*.cognome' => 'required|string',
            'calciatori.*.numero' => 'required|numeric',
            'calciatori.*.ruolo' => 'required|string',
        ]);

        $dl = new DataLayer();
        $dl->addSquadraConCalciatori($request->nome_squadra, $request->calciatori);

        return redirect()->route('squadre')->with('success', 'Squadra aggiunta con successo!');

    }

    public function edit($id)
    {
        $dl = new DataLayer();
        $squadra = $dl->findSquadraById($id);

        return view('calcio.editSquadra', compact('squadra'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nome_squadra' => 'required|string|max:255',
            'calciatori.*.nome' => 'required|string',
            'calciatori.*.cognome' => 'required|string',
            'calciatori.*.numero' => 'required|numeric',
            'calciatori.*.ruolo' => 'required|string',
        ]);

        $dl = new DataLayer();
        $dl->updateSquadra($id, $request->nome_squadra, $request->calciatori);

        return redirect()->route('squadre')->with('success', 'Squadra modificata con successo!');
    }

    public function destroy($id)
    {
        $dl = new DataLayer();
        $dl->deleteSquadra($id);

        return redirect()->route('squadre')->with('success', 'Squadra eliminata con successo!');
    }

    public function ajaxCheckSquadraNome(Request $request)
    {
        $dl = new DataLayer();

        if ($dl->squadraEsiste($request->input('nome'))) {
            $response = ['found' => true];
        } else {
            $response = ['found' => false];
        }

        return response()->json($response);
    }

    public function ajaxCheckCalciatore(Request $request)
    {
        $dl = new DataLayer();

        $found = $dl->calciatoreEsisteInAltraSquadra(
            $request->input('nome'),
            $request->input('cognome'),
            $request->input('nome_squadra') ?? ''
        );

        return response()->json(['found' => $found]);
    }


}

