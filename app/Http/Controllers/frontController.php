<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontController extends Controller
{
    public function getHome() {

        session_start();
        return view('index');
    }

    public function getStoria() {

        session_start();
        return view('storia');
    }

    public function getDirettivo() {

        session_start();
        return  view('direttivo');
    }

    public function getContatti() {

        return view('contatti');
    }

    public function getCreaEvento() {

        session_start();
        return view('eventi.creaEvento');
    }




}
