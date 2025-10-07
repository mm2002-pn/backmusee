<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;
use InvalidArgumentException;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Throwable;

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
    }


    /**
     * Rendre une exception en réponse HTTP.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Throwable  $e
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function render($request, Throwable $e)
    {
        // // Gestion des erreurs 404
        if ($e instanceof NotFoundHttpException || $e instanceof ModelNotFoundException || $e instanceof InvalidArgumentException) {
            // return response()->view('errors.404', [], 404);
            $statusCode = $this->getHttpStatusCode($e);

            return response()->view('errors.any', ['exception' => $e], $statusCode);
        }
        if ($e instanceof NotFoundHttpException) {
            return response()->view('errors.404', [], 404);
        }

        // Gestion des erreurs 405
        if ($e instanceof MethodNotAllowedHttpException) {
            return response()->view('errors.405', [], 405);
        }

        // Gestion JSON pour les API
        if ($this->shouldReturnJson($request, $e)) {
            return response()->json([
                'message' => $e->getMessage(),
                'status' => $this->getHttpStatusCode($e),
            ]);
        }

        // Gestion des autres erreurs HTTP
        if ($this->isHttpException($e)) {
            $statusCode = $this->getHttpStatusCode($e);
            if (view()->exists("errors.{$statusCode}")) {
                return response()->view("errors.{$statusCode}", [], $statusCode);
            }
            return response()->view('errors.any', ['exception' => $e], $statusCode);
        }

        // Pour toutes les autres erreurs, utiliser le comportement par défaut
        return parent::render($request, $e);
    }

    /**
     * Obtenir le code HTTP de l'exception.
     *
     * @param  \Throwable  $e
     * @return int
     */
    protected function getHttpStatusCode(Throwable $e): int
    {
        return $e instanceof HttpException && method_exists($e, 'getStatusCode')
            ? $e->getStatusCode()
            : 500;
    }

    /**
     * Gérer une exception non authentifiée.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($this->shouldReturnJson($request, $exception)) {
            return response()->json(['message' => 'Non authentifié.'], 401);
        }

        return redirect()->guest(route('login'));
    }
}
