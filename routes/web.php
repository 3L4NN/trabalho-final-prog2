<?php

use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SignUpController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*   Rotas de início   */
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/cadastro', [SignUpController::class, 'index'])->name('signup');
Route::post('/cadastro', [SignUpController::class, 'store'])->name('signup');

/*   Rotas de usuario   */
Route::middleware(['auth'])->name('user.')->group(function(){
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/novo-feedback', [FeedbackController::class, 'index'])->name('new.feedback');
    Route::post('/novo-feedback', [FeedbackController::class, 'store'])->name('sent.feedback');
    Route::get('/meus-feeedbacks', [UserController::class, 'ownerFeedback'])->name('owner');
    Route::post('/feedback-update', [FeedbackController::class, 'update'])->name('feedback.update');
    Route::post('/feedback-delete', [FeedbackController::class, 'destroy'])->name('feedback.delete');
});

