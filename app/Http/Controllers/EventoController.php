<?php

namespace App\Http\Controllers;
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
            $path = $request->file('locandina_path')->storeAs('locandine', $locandina,);
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
}
