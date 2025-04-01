<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class CaspolataController extends Controller
{
    public function index(){
        $dl = new DataLayer();
        $eventi = $dl->listCaspolate();

        return view('eventi.caspolata.caspolata')->with('caspolata_list', $eventi);
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
