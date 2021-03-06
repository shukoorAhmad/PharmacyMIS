<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App;
use Session;

class LocalizeMiddleware
{

    public function handle(Request $request, Closure $next)
    {
        App::setLocale(Session::get('locale'));
        return $next($request);
    }
}
