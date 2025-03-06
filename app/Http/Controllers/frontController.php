<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontController extends Controller
{
    public function getHome() {

        return view('index');
    }

    public function getStoria() {

        return view('storia');
    }

    public function getDirettivo() {

        return view('direttivo');
    }

    public function getContatti() {

        return view('contatti');
    }

    public function getCreaEvento() {

        return view('eventi.creaEvento');
    }




}
