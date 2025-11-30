<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StudentController;

Route::get('/home', [StudentController::class, 'index']);
Route::get('/stats', [StudentController::class, 'stats']);

// Protected routes using Bearer token
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/store', [StudentController::class, 'store']);
    Route::get('/student/{id}', [StudentController::class, 'show']);
    Route::put('/student/{id}', [StudentController::class, 'update']);
    Route::delete('/student/{id}', [StudentController::class, 'destroy']);
    Route::get('/major/{major}', [StudentController::class, 'getByMajor']);
    Route::get('/year/{year}', [StudentController::class, 'getByYear']);
    Route::get('/search', [StudentController::class, 'search']);
});
