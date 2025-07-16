<?php

use Illuminate\Support\Facades\Route;
use Laravel\Sanctum\Http\Controllers\CsrfCookieController;
use App\Http\Controllers\UserExcelController;

Route::get('/', function () {
    return ['Laravel' => app()->version()];
});

Route::get('/sanctum/csrf-cookie', [CsrfCookieController::class, 'show']);

require __DIR__.'/auth.php';

Route::get('/users/export', [UserExcelController::class, 'export']);