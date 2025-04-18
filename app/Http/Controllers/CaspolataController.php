<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CaspolataController extends Controller
{
    
    public function index()
    {
        session_start();
    
        $dl = new DataLayer();
        $eventi = $dl->listCaspolate();
    
        $mie_iscrizioni = collect();
        $utenteId = null;
    
        if (isset($_SESSION['loggedID'])) {
            $mie_iscrizioni = collect($dl->getEventiIscrittiUtente($_SESSION['loggedID']))
                                ->map(fn($id) => (int) $id);
    
            $utenteId = $_SESSION['loggedID']; 
        }
    
        return view('eventi.caspolata.caspolata', [
            'caspolata_list' => $eventi,
            'mie_iscrizioni' => $mie_iscrizioni,
            'utenteId' => $utenteId
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
