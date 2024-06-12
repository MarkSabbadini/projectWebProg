<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CaspolataController extends Controller
{
    public function index()
    {
        return view('eventi.caspolata.caspolata');
    }

    public function edit()
    {
        return view('eventi.caspolata.editCaspolata');
    }

    public function create()
    {
        return view('eventi.caspolata.iscrizioneCaspolata');
    }

}
