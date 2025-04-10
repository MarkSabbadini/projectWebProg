<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RadunoController extends Controller
{
    public function index()
{
    session_start();

    $dl = new DataLayer();
    $eventi = $dl->listRaduni(); // recupera tutti gli eventi tipo 'caspolata'

    $mie_iscrizioni = collect();
    if (isset($_SESSION['loggedID'])) {
        $mie_iscrizioni_array = $dl->getEventiIscrittiUtente($_SESSION['loggedID']); // metodo da creare nel DataLayer
        $mie_iscrizioni = collect($mie_iscrizioni_array);
    }

    return view('eventi.raduno.raduno', [
        'raduno_list' => $eventi,
        'mie_iscrizioni' => $mie_iscrizioni
    ]);
}

    // Pagina iscrizione per raduno
    public function iscrizioneRaduno()
    {
        return view('eventi.raduno.iscrizioneRaduno');
    }

}
