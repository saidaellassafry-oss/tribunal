<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\Setting;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if (session()->has('locale')) {
            App::setLocale(session('locale'));
        } else {
            $lang = Setting::where('key','language')->value('value') ?? 'fr';

            session(['locale' => $lang]);

            App::setLocale($lang);
        }

        return $next($request);
    }
}