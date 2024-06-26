<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CompanyController;
use App\Http\Controllers\Api\InvoiceController;
use App\Http\Controllers\Api\NoteController;

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/register', [AuthController::class, 'store'])->name('store');
    Route::post('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:api')->name('logout');
    Route::post('/refresh', [AuthController::class, 'refresh'])->middleware('auth:api')->name('refresh');
    Route::post('/me', [AuthController::class, 'me'])->middleware('auth:api')->name('me');
});


Route::apiResource('companies', CompanyController::class)->middleware('auth:api');

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'invoices'
], function ($router) {
    Route::post('/send', [InvoiceController::class, 'send']);
    Route::post('/xml', [InvoiceController::class, 'xml']);
    Route::post('/pdf', [InvoiceController::class, 'pdf']);
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'notes'
], function ($router) {
    Route::post('/send', [NoteController::class, 'send']);
    Route::post('/xml', [NoteController::class, 'xml']);
    Route::post('/pdf', [NoteController::class, 'pdf']);
});
