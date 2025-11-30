<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

/**
 * Laravel Application Bootstrap (Lesson 5: Models and Controllers)
 * 
 * Key Teaching Point:
 * This file configures Laravel to load both web and API routes
 * 
 * Evolution from Lesson 4:
 * - Same configuration but now routes use real database operations
 * - API routes now return real data from Student model
 */

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',     // Web routes (HTML responses)
        api: __DIR__.'/../routes/api.php',     // API routes (JSON responses) ← IMPORTANT!
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        // Middleware configuration
        // For lesson 5, we keep it simple - no additional middleware needed
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Exception handling configuration
        // Laravel automatically handles:
        // - ModelNotFoundException (404 for Route Model Binding)
        // - ValidationException (422 for validation errors)
        // - Other common exceptions
    })->create();
