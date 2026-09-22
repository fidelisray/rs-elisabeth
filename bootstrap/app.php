<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Daftarkan alias untuk middleware API Key CMS
        $middleware->alias([
            'verifyCmsHmac' => \App\Http\Middleware\VerifyCmsHmacSignature::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Pastikan semua error pada request API (/api/*) selalu dikembalikan
        // dalam format JSON yang konsisten, bukan halaman HTML error bawaan Laravel.
        $exceptions->render(function (\Throwable $e, Request $request) {
            if ($request->is('api/*')) {
                if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data yang diminta tidak ditemukan.',
                        'errors'  => null,
                    ], 404);
                }

                if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Endpoint tidak ditemukan.',
                        'errors'  => null,
                    ], 404);
                }

                if ($e instanceof \Illuminate\Validation\ValidationException) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Data yang dikirimkan tidak valid.',
                        'errors'  => $e->errors(),
                    ], 422);
                }
            }
        });
    })
    ->withCommands([
        \App\Console\Commands\RefreshGlossaryCache::class,
    ])->create();
