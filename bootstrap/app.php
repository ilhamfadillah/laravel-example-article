<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            \App\Http\Middleware\Jwt::class
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (Throwable $e, Request $request) {

            // Model Not Found
            if ($e instanceof NotFoundHttpException) {
                $message = $e->getMessage();

                $modelNamespace = explode('[', $message)[1] ?? '';
                $modelNamespace = explode(']', $modelNamespace)[0] ?? '';
                $modelName = last(explode('\\', $modelNamespace));

                return response()->json([
                    'status' => 'error',
                    'message' => $modelName . ' not found.',
                    'data' => []
                ], 404);
            }

            // Validation Error
            if ($e instanceof ValidationException) {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Validation failed',
                    'data' => $e->errors(),
                ], 422);
            }
        });
    })->create();
