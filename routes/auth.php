<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthenticationSessionController;

Route::get('/login', [AuthenticationSessionController::class, 'create'])->name('login');
Route::post('/login', [AuthenticationSessionController::class, 'store'])->name('login');
Route::post('/logout', [AuthenticationSessionController::class, 'destroy'])->name('logout');

