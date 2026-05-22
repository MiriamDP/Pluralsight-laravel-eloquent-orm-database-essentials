<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['auth'])->group(function() {
    Route::view('/', 'index')->name('home');
    Route::view('/entry', 'entry')->name('entry');
    Route::view('/settings', 'settings')->name('settings');
    Route::get('/logout', [AuthController::class, 'logout']);
});

Route::middleware(['auth'])->group(function() {
    Route::view('/admin', 'admin')->name('admin');
    Route::view('/admin/job', '/admin/job')->name('admin-job');
    Route::view('/admin/user', '/admin/user')->name('admin-user');
    Route::view('/admin/entries', '/admin/entries')->name('admin-entries');
});

Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'loginHandler']);
