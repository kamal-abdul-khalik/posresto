<?php

use App\Http\Middleware\EnsureUserCanVisitPage;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'role' => \Spatie\Permission\Middleware\RoleMiddleware::class,
            'permission' => \Spatie\Permission\Middleware\PermissionMiddleware::class,
            'role_or_permission' => \Spatie\Permission\Middleware\RoleOrPermissionMiddleware::class,
            'Excel' => Maatwebsite\Excel\Facades\Excel::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->respond(function ($response) {
            if ($response instanceof \Illuminate\Http\RedirectResponse) {
                // Handle the RedirectResponse case
                if ($response->getStatusCode() === 302) {
                    return redirect(route('login'));
                }
            } elseif ($response instanceof \Illuminate\Http\Response) {
                // Handle the Response case
                if ($response->getStatusCode() === 403) {
                    session()->flash('flash.banner', 'Mohon maaf 🙏, Anda tidak diizinkan mengunjungi halaman tersebut');
                    session()->flash('flash.bannerStyle', 'danger');
                    return redirect()->intended(route('home'));
                }
            }
            return $response;
        });
    })->create();
