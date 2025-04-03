<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DataLayer;
use Illuminate\Support\Facades\Redirect;

class UtenteController extends Controller
{
    public function index() {
    
        if (!isset($_SESSION['logged']) || $_SESSION['logged'] !== true) {
            return redirect()->route('user.login')->with('error', 'Devi essere loggato per accedere al profilo!');
        }
    
        $dl = new DataLayer();
        $userId = $_SESSION['loggedID'];
        $utente = $dl->getUserById($userId); 
    
        return view('utente.profilo')->with('utente', $utente);
    }
    
    public function update(Request $request){
        
        return Redirect::to(route('profilo'));
    }

    public function store(Request $request){
        return Redirect::to(route('profilo'));

    }

}
