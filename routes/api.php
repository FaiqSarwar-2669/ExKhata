<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\AddUserController;

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

Route::post('/user', [RegisterationController::class, 'store']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/forgotPassword', [ForgotPasswordController::class,'sendResetLink']);
Route::post('/addUser', [AddUserController::class,'store']);






Route::middleware('auth:sanctum')->group(function () {

    // routes for Rejisterations controllers

    Route::post('/userUpdate/{id}', [RegisterationController::class, 'update']);
    Route::get('/getUser/{id}', [RegisterationController::class, 'show']);
    Route::post('/changePaswword', [RegisterationController::class,'changePaswword']);

    // routes for LoginController

    Route::post('/logout', [LoginController::class, 'logout']);
});
