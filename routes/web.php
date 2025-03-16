<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\OverviewController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\StudentController;

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

Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::get('/login', [AuthController::class, 'loginPage'])->name('login');
Route::get('/register', [AuthController::class, 'registerPage'])->name('register');

Route::middleware('auth')->group(function () {
    Route::get('/', [OverviewController::class, 'index'])->name('overview');

    Route::prefix('pengajuan')->group(function () {
        Route::middleware('role:admin')->group(function () {
            Route::get('{slug}/{id}/download', [SubmissionController::class, 'download'])->name('pengajuan.download');
            Route::put('{slug}/{id}/{status}', [SubmissionController::class, 'approval'])->where('status', 'ditolak|disetujui')->name('pengajuan.approval');
        });

        Route::middleware('role:student')->group(function () {
            Route::post('{slug}', [SubmissionController::class, 'store'])->name('pengajuan.store');
            Route::get('{slug}', [SubmissionController::class, 'create'])->name('pengajuan.form');
        });

        Route::get('/', [SubmissionController::class, 'index'])->name('pengajuan');
        Route::delete('{id}', [SubmissionController::class, 'delete'])->name('pengajuan.delete');
        Route::get('{slug}/{id}', [SubmissionController::class, 'show'])->name('pengajuan.show');
    });

    Route::prefix('mahasiswa')->middleware('role:admin')->group(function () {
        Route::put('{id}', [StudentController::class, 'update'])->name('student.update');
        Route::get('{id}', [StudentController::class, 'show'])->name('student.show');
        Route::get('/', [StudentController::class, 'index'])->name('student');
    });

    Route::prefix('pengaturan')->group(function () {
        Route::put('/password', [AuthController::class, 'passwordPost'])->name('profile.password.update');
        Route::put('/profil', [AuthController::class, 'profilePost'])->name('profile.update');
        Route::get('/', [AuthController::class, 'setting'])->name('setting');
    });

    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
