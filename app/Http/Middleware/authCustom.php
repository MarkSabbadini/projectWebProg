<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Symfony\Component\HttpFoundation\Response;

class authCustom
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        session_start();

        if(!isset($_SESSION['logged'])) { //

            return response()->view('errors.404',['message' => 'PAGINA RISERVATA AGLI UTENTI REGISTRATI!']);
        }


        return $next($request); // Va avanti 
    }
}
