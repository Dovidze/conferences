<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'indexhome'])->name('welcome');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


use App\Http\Controllers\AdminController;

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
Route::put('/admin/users/{user}/update-role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
Route::get('admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edit');
Route::put('admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.update');

use App\Http\Controllers\ConferenceController;

Route::middleware(['auth'])->group(function () {
    Route::resource('conferences', ConferenceController::class);
    Route::post('conferences/{conference}/register', [ConferenceController::class, 'register'])->name('conferences.register');
    Route::delete('/conferences/{conference}', [ConferenceController::class, 'destroy'])->name('conferences.destroy');
    Route::get('/conferences/{conference}/edit', [ConferenceController::class, 'edit'])->name('conferences.edit')->middleware('auth');
    Route::put('/conferences/{conference}', [ConferenceController::class, 'update'])->name('conferences.update')->middleware('auth');
});

