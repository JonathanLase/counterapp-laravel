<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CounterController;
use App\Http\Controllers\DashboardController;

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

// Route::get('/welcome', function () {
//     return view('welcome');
// });

Route::post('/increment/{id}', [CounterController::class, 'increment']);
Route::post('/decrement/{id}', [CounterController::class, 'decrement']);
Route::get('/dashboard', [CounterController::class, 'dashboard'])->name('dashboard');
Route::post('/store', [CounterController::class, 'store'])->name('store');
Route::delete('/delete/{id}', [CounterController::class, 'delete'])->name('delete');
Route::put('/update/{id}', [CounterController::class, 'update'])->name('update');
