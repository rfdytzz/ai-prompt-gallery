<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\DataController;
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


Route::post('/prompt', [PromptController::class, 'index']);
Route::middleware('auth:sanctum')->get('/myprompt', [MypromptController::class, 'index']);
Route::get('/myprompt/data/tag', [MypromptController::class, 'getDataTag']);
Route::get('/myprompt/data/category', [MypromptController::class, 'getDataCategory']);
Route::middleware('auth:sanctum')->post('/myprompt/store', [MypromptController::class, 'store']);
Route::middleware('auth:sanctum')->get('/myprompt/edit/{id}', [MypromptController::class, 'edit']);
Route::middleware('auth:sanctum')->post('/myprompt/edit/{id}', [MypromptController::class, 'update']);

Route::get('/dashboard', [DataController::class, 'totalData']);
Route::get('/dashboard/allusers', [DataController::class, 'user']);
Route::get('/dashboard/allusers/{id}', [AdminController::class, 'user']);
Route::get('/dashboard/allusers/{id}/ban', [AuthController::class, 'ban']);
Route::get('/dashboard/allusers/{id}/unban', [AuthController::class, 'unban']);