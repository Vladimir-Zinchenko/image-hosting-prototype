<?php

use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\UploadController;
use Illuminate\Support\Facades\Route;

Route::get('/', [MainController::class, 'index']);
Route::get('/download/{id}', [MainController::class, 'download']);

Route::get('/upload', [UploadController::class, 'index']);
Route::post('/upload', [UploadController::class, 'store']);

Route::prefix('/api')->group(function () {
    Route::get('/image', [ImageController::class, 'index']);
    Route::get('/image/{id}', [ImageController::class, 'view']);
});
