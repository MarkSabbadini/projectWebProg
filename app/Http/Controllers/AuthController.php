<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\DataLayer;

class AuthController extends Controller
{
    public function authentication() {

        return view('auth.login');
    }
    
    public function login(Request $request) {
        
        session_start();
        
        $dl = new DataLayer();
        if($dl->validUser($request->input('email'), $request->input('password')))
        {
            $_SESSION['logged'] = true;
            $_SESSION['loggedID'] = $dl->getUserID($request->input('email'));
            $_SESSION['loggedName'] = $dl->getUserName($request->input('email'));
            $_SESSION['role'] = $dl->getUserRole($request->input('email'));

            return Redirect::to(route('profilo'));
        } else 
        {
            return view('errors.404')->with('message','CREDENZIALI ERRATE!');
        }
    }

    public function registration(Request $request) {
        $dl = new DataLayer();
        
       $user = $dl->addUser($request->input('name'), $request->input('registration-password'), $request->input('registration-email'));
        
        $utente = new \App\Models\Utente();
        $utente->nome = $request->input('name'); // o name/email prese dal form
        $utente->email = $request->input('registration-email');
        $utente->id_user = $user->id; // deve esistere la foreign key in `Utente`
        $utente->save();
        
        return Redirect::to(route('user.login'));
    }

    public function logout() {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    
        session_destroy();
        return Redirect::to(route('home'));
    }
}
