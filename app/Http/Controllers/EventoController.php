<?php

namespace App\Http\Controllers;
use App\Models\Evento;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class EventoController extends Controller
{
    // Form di creazione evento
    public function create()
    {
        return view('eventi.creaEvento');
    }

    // Salvataggio evento nel database
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'edizione' => 'required|integer',
            'tipo' => 'required|in:Raduno,Caspolata',
            'descrizione' => 'nullable|string|max:1000',
            //  'locandina_path' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        // $locandina_path = null;

        if ($request->hasFile('locandina_path')) {
            $locandina = $request->file('locandina_path')->getClientOriginalName();
            $path = $request->file('locandina_path')->storeAs('locandine', $locandina, 'public');
        }

        $dl = new DataLayer();

        $dl->addEvento(
            $validated['nome'],
            $validated['edizione'],
            $validated['tipo'],
            $validated['descrizione'],
            $path
        );

        return redirect()->back()->with('success', 'Evento inserito con successo!');
    }

    public function deleteEvento($id)
    {
        $dl = new DataLayer();
        $dl->deleteEvento($id);

        return redirect()->back()->with('success', 'Evento eliminato con successo!');
    }

    public function editEvento($id)
    {
        $evento = Evento::findOrFail($id);
        return view('eventi.editEvento', compact('evento'));
    }

    public function updateEvento(Request $request, $id)
    {
    $validated = $request->validate([
        'nome' => 'required|string|max:255',
        'edizione' => 'required|integer',
        'descrizione' => 'nullable|string|max:1000',
    ]);

    $evento = Evento::findOrFail($id);
    $tipo = $evento->tipo; 

    $locandina_path = null;

    if ($request->hasFile('locandina_path')) {
        $locandina = $request->file('locandina_path')->getClientOriginalName();
        $locandina_path = $request->file('locandina_path')->storeAs('locandine', $locandina, 'public');
    }

    $dl = new DataLayer();
    $dl->updateEvento(
        $id,
        $validated['nome'],
        $validated['edizione'],
        $tipo,
        $validated['descrizione'],
        $locandina_path
    );

    return redirect()->back()->with('success', 'Evento aggiornato con successo!');
}




}
