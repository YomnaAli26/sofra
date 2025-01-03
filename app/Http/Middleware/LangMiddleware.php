<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class LangMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->isStarted() && session()->has('lang')) {
            App::setLocale(session('lang','en'));
        }
        $request->headers->set('Accept', 'application/json');
        $lang = $request->header('Accept-Language');
        if (isset($lang) && strlen($lang) == 2)
        {
            App::setLocale($lang);
        }
        else
        {
            App::setLocale(config('app.locale'));
        }

        return $next($request);
    }
}
