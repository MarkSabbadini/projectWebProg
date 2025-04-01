<?php

namespace App\Http\Controllers;
use App\Models\DataLayer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RadunoController extends Controller
{
    public function index(){
        $dl = new DataLayer();
        $eventi = $dl->listRaduni();

        return view('eventi.raduno.raduno')->with('raduno_list', $eventi);
    }

    // Pagina iscrizione per raduno
    public function iscrizioneRaduno()
    {
        return view('eventi.raduno.iscrizioneRaduno');
    }

}
