<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function swapLanguage(): void
    {
        $locale = $_GET['locale'];
        if (! in_array($locale, Language::select('slug')->pluck('slug')->toArray()))
            $locale = config('app.locale');

        App::setLocale($locale);
        session(['locale' => $locale]);
    }
}
