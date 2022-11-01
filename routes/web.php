<?php

use App\Http\Controllers\ChirpController;
use App\Http\Controllers\SSOController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/auth/google', [SSOController::class, 'google'])->name('requestToGoogle'); 
Route::get('/auth/google/callback', [SSOController::class, 'googleHandler']);


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::resource('chirps', ChirpController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy'])
        // ->except(['show', 'create'])
    ;
});

require __DIR__.'/auth.php';
