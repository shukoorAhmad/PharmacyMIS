<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LocalizeMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        App::setLocale(Session::get('locale'));
        return $next($request);
    }
}
