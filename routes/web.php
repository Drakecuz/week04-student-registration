<?php

use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Show the registration form
Route::get('/register', [StudentController::class, 'create'])->name('students.create');

// Store the registration
Route::post('/register', [StudentController::class, 'store'])->name('students.store');

// Show student profile
Route::get('/students/{student}', [StudentController::class, 'show'])->name('students.show');

// Redirect root to registration form
Route::get('/', function () {
    return redirect()->route('students.create');
});