<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CaspolataController extends Controller
{
    // CaspolataController.php (o EventoController.php)
    public function index()
    {
        session_start();
    
        $dl = new DataLayer();
        $eventi = $dl->listCaspolate();
    
        $mie_iscrizioni = collect();
        if (isset($_SESSION['loggedID'])) {
            $mie_iscrizioni = collect($dl->getEventiIscrittiUtente($_SESSION['loggedID']))
                                ->map(fn($id) => (int) $id);
        }
    
        return view('eventi.caspolata.caspolata', [
            'caspolata_list' => $eventi,
            'mie_iscrizioni' => $mie_iscrizioni
        ]);
    }
    

    // Form di creazione evento
    public function create()
    {
        return view('eventi.creaEvento');
    }

    // Pagina iscrizione per caspolata
    public function iscrizioneCaspolata()
    {
        return view('eventi.caspolata.iscrizioneCaspolata');
    }
    
}
