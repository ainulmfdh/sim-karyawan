<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('login');
});

// Route Dashboard
Route::get('/dashboard', [EmployeeController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    // Route seluruh employee
    Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show');
    Route::get('/employees/{employee}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/employees/{employee}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/employees/{employee}', [EmployeeController::class, 'destroy'])->name('employees.destroy');
    Route::get('employees/history/all', [EmployeeController::class, 'allHistory'])->name('employees.all-history');
    Route::get('employees/export/form', [EmployeeController::class, 'exportForm'])->name('employees.export.form');
    Route::post('employees/export/store', [EmployeeController::class, 'storeReport'])->name('employees.export.store');
    Route::get('employees/export/excel/{period}', [EmployeeController::class, 'exportExcel'])->name('employees.export.excel');
    Route::get('documentation', [EmployeeController::class, 'docs'])->name('employees.docs');
});

require __DIR__.'/auth.php';
