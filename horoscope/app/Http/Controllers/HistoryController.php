<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class HistoryController extends Controller
{
    function index(): View
    {
        return view('dashboard.pattern.planet.index');
    }

    function result(int $id): View
    {
        return view('dashboard.pattern.planet.view');
    }
}
