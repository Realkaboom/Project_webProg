<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\App;

class SetLocale
{
    /**
     * Handle an incoming request.
     */
    public function handle($request, Closure $next)
    {
        $supported = ['id', 'en'];
        $lang = $request->query('lang') ?? session('locale', config('app.locale'));

        if (! in_array($lang, $supported, true)) {
            $lang = config('app.locale');
        }

        session(['locale' => $lang]);
        App::setLocale($lang);

        return $next($request);
    }
}
