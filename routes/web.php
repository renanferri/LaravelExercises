<?php

use App\Http\Controllers\Bracket\BracketController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/brackets', [BracketController::class, 'index'])->name('brackets.index');
Route::post('/brackets', [BracketController::class, 'runValidator'])->name('brackets.validator');;