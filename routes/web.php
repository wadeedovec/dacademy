<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ExamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'chart'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('exams', ExamController::class);
    Route::post('/exam/{exam}/submit', [ExamController::class, 'submit'])->name('exam.submit');
    Route::get('/exams/{exam}/questions/create', [ExamController::class, 'createQuestions'])->name('exams.questions.create');
    Route::post('/exams/{exam}/questions', [ExamController::class, 'storeQuestions'])->name('exams.questions.store');
    Route::get('/exams/{exam}/edit', [ExamController::class, 'edit'])->name('exams.edit');
    Route::put('/exams/{exam}', [ExamController::class, 'update'])->name('exams.update');
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::group(['middleware' => ['permission:create-user']], function () {
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/admin/users', [UserController::class, 'store'])->name('users.store');
    });
});
require __DIR__ . '/auth.php';
