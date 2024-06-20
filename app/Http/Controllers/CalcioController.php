<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalcioController extends Controller
{
    public function index() {
        
        return view('calcio.squadre');
    }

    public function torneo() {

        return view('calcio.torneo');
    }
}
