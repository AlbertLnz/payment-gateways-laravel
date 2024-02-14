<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsSubscribed
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        
        if($request->user()->subscribed('Suscripciones blog')) {
            
            return $next($request);

        } else {

            session()->flash('flash.banner', '¡Te has de suscribir a un plan para ver el contenido de cada artículo!');

            return redirect()->route('billing.index');

        }

    }
}
