<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;

class LocaleController extends Controller
{
    public function __invoke(Request $request, string $locale): RedirectResponse
    {
        abort_unless(array_key_exists($locale, config('app.locales')), 404);

        // Cookie for ~5 years: keeps the choice after logout and for the login page.
        Cookie::queue(Cookie::forever('locale', $locale));

        // Logged in? Also store it on the user, so it follows them to other devices.
        $request->user()?->update(['locale' => $locale]);

        return back();
    }
}
