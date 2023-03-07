<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;
use App\Http\Controllers\UserController;

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

// Authentication
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// News
Route::get('/news',[NewController::class, 'index'])->name('news');

Route::get('/news/create',[NewController::class, 'create']);
Route::post('/news',[NewController::class, 'store']);

Route::put('/news/{id}', [NewController::class, 'update']);
Route::get('/news/{id}/edit', [NewController::class, 'edit']);

Route::delete('/news/{id}', [NewController::class, 'destroy']);

// User
Route::get('/user', [UserController::class, 'index'])->name('user');

// Route::get('/user/create',[UserController::class, 'create']);
Route::post('/user',[UserController::class, 'store']);

// Route::put('/user/{id}', [UserController::class, 'update']);
Route::get('/user/{id}/edit', [UserController::class, 'edit']);

Route::delete('/user/{id}', [UserController::class, 'destroy']);

