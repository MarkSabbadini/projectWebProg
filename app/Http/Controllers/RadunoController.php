<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RadunoController extends Controller
{
    public function index()
    {
        return view('eventi.raduno.raduno');
    }

    public function create()
    {
        return view('eventi.caspolata.editRaduno');
    }

    public function getIscrizioneRadunoSingolo()
    {
        return view('eventi.raduno.iscrizioneRadunoSingolo');
    }

    public function getIscrizioneRadunoGruppo()
    {
        return view('eventi.raduno.iscrizioneRadunoGruppo');
    }
}

