<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\StudentController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route::get('admin/dashboard', [AdminController::class, 'index'])->middleware(['auth', 'admin']);
// Route::get('admin/dashboard', [HomeController::class, 'adminIndex'])->middleware(['auth', 'admin']);
// Route::get('advisor/dashboard', [AdvisorController::class, 'advisorIndex']);
// Route::middleware(['auth:advisors'])->get('advisor/dashboard', [AdvisorController::class, 'Index']);

Route::middleware(['auth:advisors'])->group(function () {
    Route::get('admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');

    Route::get('admin/advisor/index', [AdminController::class, 'advisorIndex'])->name('admin.advisor.index');
    Route::get('admin/advisor/create', [AdminController::class, 'advisorCreate'])->name('admin.advisor.create');
    Route::post('admin/advisor/store', [AdminController::class, 'advisorStore'])->name('admin.advisor.store');

    Route::get('admin/academic-year/index', [AdminController::class, 'academicYearIndex'])->name('admin.academic-year.index');
    Route::get('admin/major/index', [MajorController::class, 'index'])->name('admin.major.index');

    Route::prefix('admin/student')->name('admin.student.')->group(function () {
        Route::get('index', [AdminController::class, 'studentIndex'])->name('index');
        Route::get('create', [AdminController::class, 'studentCreate'])->name('create');
        Route::post('store', [AdminController::class, 'studentStore'])->name('store');
    });

    Route::prefix('admin/major')->name('admin.major.')->group(function () {
        Route::get('index', [MajorController::class, 'index'])->name('index');
        Route::get('create', [MajorController::class, 'create'])->name('create');
        Route::post('store', [MajorController::class, 'store'])->name('store');
    });

    Route::get('admin/academic-year/create', [AcademicYearController::class, 'create'])->name('admin.academic-year.create');
    Route::post('admin/academic-year/store', [AcademicYearController::class, 'store'])->name('admin.academic-year.store');

    Route::get('teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('advisor/dashboard', [AdvisorController::class, 'index'])->name('advisor.dashboard');
});


require __DIR__ . '/auth.php';
