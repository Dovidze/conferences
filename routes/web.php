<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{AdminController, ConferenceController, HomeController};

Route::group(['middleware' => \ied3vil\LanguageSwitcher\Middleware\LanguageSwitcherMiddleware::class], function () {

    Auth::routes();

    Route::get('/', [ConferenceController::class, 'welcome'])->name('welcome');
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::put('/admin/users/{user}/update-role', [AdminController::class, 'updateRole'])->name('admin.updateRole');
    Route::get('admin/users/{id}/edit', [AdminController::class, 'editUser'])->name('admin.edit');
    Route::put('admin/users/{id}', [AdminController::class, 'updateUser'])->name('admin.update');

    Route::get('conferences/list', [ConferenceController::class, 'list'])->name('conferences.list');
    Route::resource('conferences', ConferenceController::class);
    Route::post('conferences/{conference}/register', [ConferenceController::class, 'register'])->name('conferences.register');
    Route::delete('/conferences/{conference}', [ConferenceController::class, 'destroy'])->name('conferences.destroy');
    Route::get('/conferences/{conference}/edit', [ConferenceController::class, 'edit'])->name('conferences.edit')->middleware('auth');
    Route::delete('/conferences/{conference}/unregister', [ConferenceController::class, 'unregister'])->name('conferences.unregister');
});


