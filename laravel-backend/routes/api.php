<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AuthController;





Route::middleware(['cors'])->group(function () {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    

    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/user', fn (Request $request) => $request->user());
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/showClients', [ClientController::class, 'getAllClient']);
        Route::post('/newClient', [ClientController::class, 'createClient']);
        Route::post('/editClient', [ClientController::class, 'updateClient']);
        Route::delete('/deleteClient', [ClientController::class, 'deleteClient']);
    });
});

