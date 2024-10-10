<?php

namespace App\Http\Controllers\Language;

use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    function index(string $langCode): RedirectResponse
    {
        App::setlocale($langCode);
        Session::put('lang_code', $langCode);
        return redirect()->back();
    }
}
