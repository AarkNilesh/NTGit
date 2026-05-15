<?php

use App\Http\Controllers\NumerologyController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/clients', [NumerologyController::class, 'clients']);
    Route::post('/clients', [NumerologyController::class, 'storeClient']);
    Route::get('/clients/{client}/report', [NumerologyController::class, 'report']);
    Route::post('/clients/{client}/payments', [NumerologyController::class, 'pay']);
});
