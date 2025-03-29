<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CaspolataController extends Controller
{
    public function index(){
        $dl = new DataLayer();
        $eventi = $dl->listEventi();

        return view('eventi.caspolata.caspolata')->with('caspolata_list', $eventi);
    }


    // Homepage per gli eventi Raduno
    public function radunoIndex()
    {
        $eventi = $this->$dl->listEventiByTipo('Raduno');
        return view('eventi.raduno.raduno', compact('eventi'));
    }

    // Homepage per gli eventi Caspolata
    public function caspolataIndex()
    {
        $eventi = $this->dl->listEventiByTipo('Caspolata');
        return view('eventi.caspolata.caspolata', compact('eventi'));
    }

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
            'locandina' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);

        $locandinaPath = null;

        if ($request->hasFile('locandina')) {
            $locandinaPath = $request->file('locandina')->store('locandine', 'public');
        }

        $this->dl->addEvento(
            $validated['nome'],
            $validated['edizione'],
            $validated['tipo'],
            $validated['descrizione'],
            $locandinaPath
        );

        return redirect()->back()->with('success', 'Evento inserito con successo!');
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
