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
        $eventi = $dl->listRaduni(); // recupera tutti gli eventi di tipo "raduno"

        $mie_iscrizioni = collect();
        $utenteId = null;

        if (isset($_SESSION['loggedID'])) {
            $mie_iscrizioni = collect($dl->getEventiIscrittiUtente($_SESSION['loggedID']))
                                ->map(fn($id) => (int) $id);

            $utenteId = $_SESSION['loggedID'];
        }

        return view('eventi.raduno.raduno', [
            'raduno_list' => $eventi,
            'mie_iscrizioni' => $mie_iscrizioni,
            'utenteId' => $utenteId
        ]);
    }

    // Pagina iscrizione per raduno
    public function iscrizioneRaduno()
    {
        return view('eventi.raduno.iscrizioneRaduno');
    }
}
