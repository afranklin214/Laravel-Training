<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        $this->reportable(function (Throwable $e) {
            parent::report($e);
        });

        $this->renderable(function (Exception $e, $request) {
            if ($e->getPrevious() instanceof ModelNotFoundException) {
            return response()->json([
                'status' => 404,
                'message' => 'Not found'
            ], 404);
            }
            if ($e->getPrevious() instanceof AuthorizationException) {
                return response()->json([
                    'status' => 403,
                    'message' => $e->getMessage()
                ], 403);
            }
            return parent::render($request, $e);
        });
    }
}
