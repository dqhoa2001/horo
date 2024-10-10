<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    /**
     * The names of the attributes that should not be trimmed.
     *
     * @var array<int, string>
     */
    protected $except = [
        'current_password',
        'password',
        'password_confirmation',
        'content',
        'content_en',
        'content_solar',
        'content_solar_en',
        'title_solar',
        'title_solar_en',
        'title',
        'title_en',
    ];
}
