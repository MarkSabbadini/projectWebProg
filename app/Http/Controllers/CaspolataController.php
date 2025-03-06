<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaspolataController extends Controller
{
    public function index()
    {
        return view('eventi.caspolata.caspolata');
    }

    public function create()
    {
        return view('eventi.creaEvento');
    }

    public function getIscrizioneCaspolata()
    {
        return view('eventi.caspolata.iscrizioneCaspolata');
    }
}
