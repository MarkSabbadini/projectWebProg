<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RadunoController extends Controller
{
    public function index()
    {
        return view('eventi.raduno.raduno');
    }
}

