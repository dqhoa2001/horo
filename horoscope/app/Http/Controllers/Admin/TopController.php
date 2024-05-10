<?php

namespace App\Http\Controllers\Admin;

use Illuminate\View\View;
use App\Http\Controllers\Controller;

class TopController extends Controller
{
    public function top(): View
    {
        return view('admin.top');
    }
}
