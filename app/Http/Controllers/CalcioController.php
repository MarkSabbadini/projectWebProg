<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcioController extends Controller
{
    public function index() {
        
        session_start();
        return view('calcio.squadre');
    }

    public function torneo() {

        session_start();

        return view('calcio.torneo');
    }

    public function risultati() {

        session_start();

        return view('calcio.risultati');
    }
}
