<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DocumentsController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ToolsController;
use App\Http\Controllers\CommitteesController;
use App\Http\Controllers\CommitteeMeetingsController;
use App\Http\Controllers\CommitteeMembersController;

Route::get('/', function () {
    return view('welcome');
});

# Login Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login'])->name('login.post');
});

# Logout
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

# Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');
    Route::get('/documents', [DocumentsController::class, 'index'])->name('documents');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/tools', [ToolsController::class, 'index'])->name('tools');
    Route::get('/committees', [CommitteesController::class, 'index'])->name('committees.index');
    Route::get('/committees/{committee:slug}', [CommitteesController::class, 'show'])->name('committees.show');
    Route::get('/committees/{committee:slug}/meetings', [CommitteeMeetingsController::class, 'index'])
        ->name('committees.meetings.index');
    Route::get('/committees/{committee:slug}/members', [CommitteeMembersController::class, 'index'])
        ->name('committees.members.index');
});


