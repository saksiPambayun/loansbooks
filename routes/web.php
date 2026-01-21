<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('index');


Route::get('/katalog', [BookController::class, 'katalog'])->name('katalog');
Route::get('/detail/{id}', [BookController::class, 'detail'])->name('detail');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', function () {
        if (auth()->guard('web')->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('student.dashboard');
    })->name('dashboard');

    Route::middleware(['role:Admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard'); // You can create a specific admin dashboard view later
        })->name('dashboard');

        Route::resource('students', StudentController::class)->names('students');
        Route::resource('classrooms', ClassroomController::class)->names('classrooms');

        Route::prefix('loans')->name('loans.')->group(function () {
            Route::get('/', [LoanController::class, 'index'])->name('index');
            Route::get('/create', [LoanController::class, 'create'])->name('create');
            Route::post('/store', [LoanController::class, 'store'])->name('store');
            Route::get('/{loan}', [LoanController::class, 'show'])->name('show');
            Route::post('/{id}/approve', [LoanController::class, 'approve'])->name('approve');
            Route::post('/{id}/reject', [LoanController::class, 'reject'])->name('reject');
            Route::post('/{id}/return', [LoanController::class, 'return'])->name('return');
            Route::get('/status/overdue', [LoanController::class, 'checkOverdue'])->name('overdue');
        });

        // Semua route admin/books sudah diamankan dengan middleware 'auth' dan 'role:Admin' di bawah ini:
        // Jika user belum login, otomatis diarahkan ke halaman login
        // Jika ingin menambah route lain yang harus login, tambahkan ke dalam group ini
        Route::resource('books', BookController::class)->names([
            'index' => 'books.index',
            'create' => 'books.create',
            'store' => 'books.store',
            'show' => 'books.show',
            'edit' => 'books.edit',
            'update' => 'books.update',
            'destroy' => 'books.destroy',
        ]);
    });

    Route::middleware(['role:Student'])->prefix('student')->name('student.')->group(function () {
        Route::get('/dashboard', function () {
            return view('dashboard');
        })->name('dashboard');

        Route::prefix('loans')->name('loans.')->group(function () {
            Route::get('/', [LoanController::class, 'studentIndex'])->name('index');
            Route::post('/store', [LoanController::class, 'studentStore'])->name('store');
        });
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
