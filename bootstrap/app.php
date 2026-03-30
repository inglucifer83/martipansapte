<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckLocale;
use App\Http\Middleware\AddVariables;
use App\Http\Middleware\ContentSecurity;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
        using: function () {
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
            
            
			Route::middleware('web')
				->prefix('admin')
				->group(base_path('routes/admin.php'));

        }
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
			CheckLocale::class,
			AddVariables::class,
			ContentSecurity::class
	]);

        
        
		
		
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();