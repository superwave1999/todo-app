<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoListController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post('/login', [AuthController::class, 'login']);
//TODO: Fix this.
//Route::middleware('auth:sanctum')->group(function () {
Route::apiResource('list', TodoListController::class);
Route::post('list/complete/{id}', [TodoListController::class, 'markComplete']);
Route::post('list/share/{id}', [TodoListController::class, 'shareWithUser']);
//});
