<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('student.dashboard');
    })->name('dashboard');

    Route::middleware(['role:Admin'])->group(function () {
        Route::get('/admin/dashboard', function () {
            return view('dashboard'); // You can create a specific admin dashboard view later
        })->name('admin.dashboard');
    });

    Route::middleware(['role:Student'])->group(function () {
        Route::get('/student/dashboard', function () {
            return view('dashboard'); // You can create a specific student dashboard view later
        })->name('student.dashboard');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
