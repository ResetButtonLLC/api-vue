<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
     *
     * @return void
     */
    public function register()
    {

        $this->reportable(function (Throwable $e) {
            //
        });


        $this->renderable(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                if ($e->getPrevious() instanceof ModelNotFoundException) {
                    return response(null,404,['content-type' => 'application/json']);
                }
            }
        });

        $this->renderable(function (AccessDeniedHttpException $e, $request) {
            return response()->noContent(403);
        });

    }

    /* Laravel 7 method
    public function render($request, Throwable $e)
    {
        if ($e instanceof ModelNotFoundException) {
            return response('',404,['content-type' => 'application/json']);
        }

    }
    */


}
