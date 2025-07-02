<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;

class Handler extends ExceptionHandler
{
    protected $levels = [];

    protected $dontReport = [];

    protected $dontFlash = [
        'password',
    ];

    public function register()
    {
        $this->renderable(function (AuthenticationException $e, $request) {
            return response()->json([
                'status_code' => 401,
                'success' => false,
                'message' => 'Unauthenticated.'
            ], 401);
        });
    }
}
