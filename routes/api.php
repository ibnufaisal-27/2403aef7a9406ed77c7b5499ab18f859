<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SendEmailController;
use App\Http\Controllers\Api\AuthController;
use  App\Http\Controllers\UserController;


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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:api']], function (){
    Route::get('/user', [UserController::class, 'profile']);
    Route::patch('/user', [UserController::class, 'patch']);
    Route::post('/user/logout', [UserController::class, 'logout']);
    Route::post('/user/delete', [UserController::class, 'delete']);
    Route::post('/send-email', [SendEmailController::class, 'sendEmail']);
});

Route::post('/register', [UserController::class, 'register']);
Route::post('/user/login', [UserController::class, 'login']);