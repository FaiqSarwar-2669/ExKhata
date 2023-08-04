<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
use App\Http\Controllers\RegisterationController;

Route::post('/Get/{id}', [RegisterationController::class, 'update'])->name('userUpdate');

Route::get('/', function () {
    return view('welcome');
});
