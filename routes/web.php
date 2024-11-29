<?php

use App\Http\Controllers\AcademicYearController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdvisorController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\ProposeController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth:advisors'])->group(function () {
    Route::prefix('admin/advisor')->name('admin.advisor.')->group(function () {
        Route::get('index', [AdminController::class, 'advisorIndex'])->name('index');
        Route::get('create', [AdminController::class, 'advisorCreate'])->name('create');
        Route::post('store', [AdminController::class, 'advisorStore'])->name('store');
    });

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

    Route::prefix('admin/academic-year')->name('admin.academic-year.')->group(function () {
        Route::get('index', [AdminController::class, 'academicYearIndex'])->name('index');
        Route::get('create', [AcademicYearController::class, 'create'])->name('create');
        Route::post('store', [AcademicYearController::class, 'store'])->name('store');
    });

    Route::get('teacher/dashboard', [TeacherController::class, 'index'])->name('teacher.dashboard');
    Route::get('advisor/dashboard', [AdvisorController::class, 'dashboard'])->name('advisor.dashboard');
});


Route::middleware(['auth:students'])->group(function () {

    Route::prefix('student/group')->name('student.group.')->group(function () {
        Route::get('index', [StudentController::class, 'groupIndex'])->name('index');
        Route::get('create', [StudentController::class, 'groupCreate'])->name('create');
        Route::post('store', [StudentController::class, 'groupStore'])->name('store');
    });

    // Route::get('student/propose/index', [StudentController::class, 'proposeIndex'])->name('student.propose.index');
    // Route::get('student/propose/create', [StudentController::class, 'proposeCreate'])->name('student.propose.create');
    // Route::post('student/propose/store', [StudentController::class, 'proposeStore'])->name('student.propose.store');
    // Route::get('student/propose/{id}/edit', [StudentController::class, 'proposeEdit'])->name('student.propose.edit');
    // Route::put('student/propose/{id}', [StudentController::class, 'proposeUpdate'])->name('student.propose.update');
    Route::prefix('student/propose')->name('student.propose.')->group(function () {
        Route::get('index', [StudentController::class, 'proposeIndex'])->name('index');
        Route::get('create', [StudentController::class, 'proposeCreate'])->name('create');
        Route::post('store', [StudentController::class, 'proposeStore'])->name('store');
        Route::get('{id}/edit', [StudentController::class, 'proposeEdit'])->name('edit');
        Route::put('{id}', [StudentController::class, 'proposeUpdate'])->name('update');
    });

    Route::get('teacher/calendar/home', [TeacherController::class, 'calendarHome'])->name('teacher.calendar.home');
});


Route::middleware(['auth:advisors'])->group(function () {
    Route::get('advisor/propose/index', [AdvisorController::class, 'proposeIndex'])->name('advisor.propose.index');
    Route::get('advisor/propose/{id}/approve', [AdvisorController::class, 'approveView'])->name('advisor.propose.approveView');
    Route::put('advisor/propose/{id}', [AdvisorController::class, 'approve'])->name('advisor.propose.approve');
});

Route::middleware(['auth:advisors'])->group(function () {
    Route::get('teacher/calendar/index', [TeacherController::class, 'calendarIndex'])->name('teacher.calendar.index');
    Route::get('teacher/calendar/create', [TeacherController::class, 'calendarCreate'])->name('teacher.calendar.create');
    Route::post('teacher/calendar/store', [TeacherController::class, 'calendarStore'])->name('teacher.calendar.store');
});

Route::post('student.logout', [AuthenticatedSessionController::class, 'studentLogout'])->name('studentLogout.logout');
Route::post('advisor.logout', [AuthenticatedSessionController::class, 'advisorLogout'])->name('advisorLogout.logout');



require __DIR__ . '/auth.php';
