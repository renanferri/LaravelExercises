<?php

use App\Http\Controllers\Api\ContactController;
use App\Http\Controllers\Api\PersonController;
use Illuminate\Http\Request;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('persons')->group(function() {
    Route::get('/', [PersonController::class, 'index'])->name('persons.index');
    // Route::get('/create', [PersonController::class, 'create'])->name('persons.create');
    Route::post('/', [PersonController::class, 'store'])->name('persons.store');
    Route::get('/{person}', [PersonController::class, 'show'])->name('persons.show');
    Route::get('/{person}/edit', [PersonController::class, 'edit'])->name('persons.edit');
    Route::put('/{person}', [PersonController::class, 'update'])->name('persons.update');
    Route::delete('/{person}', [PersonController::class, 'destroy'])->name('persons.destroy');
});

Route::prefix('contacts')->group(function() {
    Route::get('/', [ContactController::class, 'index'])->name('contacts.index');
    // Route::get('/create', [ContactController::class, 'create'])->name('contacts.create');
    Route::post('/', [ContactController::class, 'store'])->name('contacts.store');
    Route::get('/{contact}', [ContactController::class, 'show'])->name('contacts.show');
    Route::get('/{contact}/edit', [ContactController::class, 'edit'])->name('contacts.edit');
    Route::put('/{contact}', [ContactController::class, 'update'])->name('contacts.update');
    Route::delete('/{contact}', [ContactController::class, 'destroy'])->name('contacts.destroy');
});
