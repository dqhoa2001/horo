<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Session\TokenMismatchException;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(static function (Throwable $e) {
            //
        });
    }

    protected function renderHttpException($e)
    {
        $status = $e->getStatusCode();
        return response()->view("errors.common", ['exception' => $e], $status);
    }

    //セッションタイムアウトの場合のリダイレクト先
    public function render($request, \Throwable $e)
    {
        if ($e instanceof TokenMismatchException) {
            return redirect()->back();
        }
        return parent::render($request, $e);
    }
}
