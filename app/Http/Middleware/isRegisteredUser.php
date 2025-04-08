<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class isRegisteredUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {   
        
        if ((!isset($_SESSION['role']))||($_SESSION['role']!='registered_user')) {
            return response()->view('errors.404',['message' => 'REGISTRATI PER ACCEDERE A QUESTA PAGINA!']);
        }

        return $next($request);
    }
}
