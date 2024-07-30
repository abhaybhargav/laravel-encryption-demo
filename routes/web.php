<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EncryptionController;

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

// Authentication Routes
Auth::routes();

// Home Route
Route::get('/', [EncryptionController::class, 'index'])->name('home');

// Encryption Routes
Route::get('/encryption', [EncryptionController::class, 'index'])->name('encryption.index');
Route::post('/encryption', [EncryptionController::class, 'store'])->name('encryption.store');
Route::get('/decrypt/{id}', [EncryptionController::class, 'decrypt'])->name('encryption.decrypt');