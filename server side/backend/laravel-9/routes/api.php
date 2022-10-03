<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



// login
Route::POST('/auth/login', [AuthController::class, 'login']);

// logout
Route::POST('/auth/logout', [AuthController::class, 'logout']);

// me
Route::POST('/auth/me', [AuthController::class, 'me']);

// reset password
Route::POST('/auth/reset_password', [AuthController::class, 'resetPassword']);