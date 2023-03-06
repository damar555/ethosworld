<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;

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

// Route::resource('news', NewController::class);

Route::get('/news',[NewController::class, 'index'])->name('news');

Route::get('/news/create',[NewController::class, 'create']);
Route::post('/news',[NewController::class, 'store']);

Route::put('/news/{id}', [NewController::class, 'update']);
Route::get('/news/{id}/edit', [NewController::class, 'edit']);

Route::delete('/news/{id}', [NewController::class, 'destroy']);