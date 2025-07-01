<?php

namespace App\Http\Middlewares;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocaleFromRequest
{
    public function handle(Request $request, Closure $next): Response
    {
        $locale = $request->header("Accept-Language");

        if (in_array($locale, ["uz", "ru"])) {
            App::setLocale($locale);
        } else {
            App::setLocale(config("app.locale"));
        }

        return $next($request);
    }
}
