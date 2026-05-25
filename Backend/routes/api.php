<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\MypromptController;
use App\Http\Controllers\PromptController;
use App\Http\Controllers\Api\SaveController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::post('/login', [AuthController::class, 'login']);
Route::post('/login/username', [AuthController::class, 'login_username']);
Route::post('/register', [AuthController::class, 'register']);
Route::middleware('auth:sanctum')->post('/save-changes', [SaveController::class, 'save']);
Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);
Route::middleware('auth:sanctum')->post('/change-password', [ChangePasswordController::class, 'index']);


Route::get('/prompt', [PromptController::class, 'index']);
Route::middleware('auth:sanctum')->get('/myprompt', [MypromptController::class, 'index']);
