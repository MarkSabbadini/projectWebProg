<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RadunoController extends Controller
{
    public function index(){
        $dl = new DataLayer();
        $films = $dl->listEventi();

        return view('eventi.raduno.raduno')->with('raduno_list', $films);
    }

    // Pagina iscrizione per raduno
    public function iscrizioneRaduno()
    {
        return view('eventi.raduno.iscrizioneRaduno');
    }

    // Pagina iscrizione per caspolata
    public function iscrizioneCaspolata()
    {
        return view('eventi.caspolata.iscrizioneCaspolata');
    }

    // (Opzionale) Visualizza un singolo evento
    public function show($id)
    {
        $evento = $this->dl->findEventoById($id);

        if (!$evento) {
            abort(404);
        }

        return view('eventi.show', compact('evento'));
    }

    // (Opzionale) Cancella un evento
    public function destroy($id)
    {
        $this->dl->deleteEvento($id);
        return redirect()->back()->with('success', 'Evento eliminato con successo!');
    }

    // (Opzionale) Form modifica evento
    public function edit($id)
    {
        $evento = $this->dl->findEventoById($id);
        if (!$evento) {
            abort(404);
        }

        return view('eventi.editEvento', compact('evento'));
    }

    // (Opzionale) Aggiorna evento
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            'edizione' => 'required|integer',
            'tipo' => 'required|in:Raduno,Caspolata',
            'descrizione' => 'nullable|string|max:1000',
            'locandina' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $locandinaPath = null;

        if ($request->hasFile('locandina')) {
            $locandinaPath = $request->file('locandina')->store('locandine', 'public');
        }

        $this->dl->editEvento(
            $id,
            $validated['nome'],
            $validated['edizione'],
            $validated['tipo'],
            $validated['descrizione'],
            $locandinaPath
        );

        return redirect()->back()->with('success', 'Evento aggiornato con successo!');
    }
}
