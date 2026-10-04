<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    /**
     * Pick the language for this request, in this order:
     *  1. the logged-in user's saved language (database)  -> follows the user everywhere
     *  2. the 'locale' cookie                              -> works for guests / login page, survives logout
     *  3. the default from config/app.php (APP_LOCALE)
     */
    public function handle(Request $request, Closure $next): Response
    {
        $supported = array_keys(config('app.locales'));

        $locale = $request->user()?->locale
            ?? $request->cookie('locale')
            ?? config('app.locale');

        if (! in_array($locale, $supported, true)) {
            $locale = config('app.locale');
        }

        App::setLocale($locale);

        return $next($request);
    }
}
