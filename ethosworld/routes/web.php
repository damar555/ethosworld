<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NewController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\EthosWorldController;
use App\Http\Controllers\MemoController;


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

// Company Profile
Route::get('/ethosworld', [EthosWorldController::class, 'index'])->name('ethosworld');

// Authentication
Route::get('/login', [AuthenticationController::class, 'loginForm'])->name('login');
Route::post('/login', [AuthenticationController::class, 'login']);

Route::get('/register', [AuthenticationController::class, 'registerForm'])->name('register');
Route::post('/register', [AuthenticationController::class, 'register']);

Route::middleware('auth')->group(function () {
    // Logout
    Route::get('/logout', [AuthenticationController::class, 'logout'])->name('logout');

    // Dashboard
    Route::get('/', function () {
        return view('welcome');
    });

    // News
    Route::get('/news',[NewController::class, 'index'])->name('news');
    Route::post('/news',[NewController::class, 'store']);
    Route::put('/news/{id}', [NewController::class, 'update']);
    Route::get('/news/{id}', [NewController::class, 'edit']);
    Route::delete('/news/{id}', [NewController::class, 'destroy']);

    // User
    Route::get('/user', [UserController::class, 'index'])->name('user');
    Route::post('/user',[UserController::class, 'store']);
    Route::get('/user/{id}/edit', [UserController::class, 'edit']);
    Route::delete('/user/{id}', [UserController::class, 'destroy']);

    // Category
    Route::get('/category', [CategoryController::class, 'index'])->name('category');
    Route::get('/category/create', [CategoryController::class, 'create']);
    Route::post('/category', [CategoryController::class, 'store']);
    Route::delete('/category/{id}', [CategoryController::class, 'destroy']);

    // Memo
    Route::get('/memo', [MemoController::class, 'index'])->name('memo');
    Route::get('/memo/create', [MemoController::class, 'create']);
    Route::post('/memo', [MemoController::class, 'store']);
    Route::get('/memo/update', [MemoController::class, 'update']);
    Route::get('/memo/{id}', [MemoController::class, 'edit']);
    Route::get('/destroy/{id}', [MemoController::class, 'destroy']);
});




