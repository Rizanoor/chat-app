<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StatusController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/', [HomeController::class, 'index']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/chat/{user}', [ChatController::class, 'show'])->name('chat');

    Route::get('/messages/{user}', [ChatController::class, 'index']);
    Route::post('/messages/{user}', [ChatController::class, 'sendMessage']);
    Route::post('/messages/read/{message}', [ChatController::class, 'markAsRead']);

    Route::get('/contact', [ContactController::class, 'index'])->name('contact');
    Route::post('/contacts', [ContactController::class, 'store']);

    Route::get('/groups', [GroupController::class, 'index']);
    Route::post('/groups', [GroupController::class, 'store']);
    Route::get('/groups/{id}', [GroupController::class, 'show']);
    Route::put('/groups/{id}', [GroupController::class, 'update']);
    Route::post('/groups/{group}/messages', [GroupController::class, 'sendMessage']);
    
    Route::get('/status', [StatusController::class, 'index']);


});

require __DIR__ . '/auth.php';
