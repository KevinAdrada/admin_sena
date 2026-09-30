<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TrainingCenterController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\EnvironmentController;
use App\Http\Controllers\AdminController;
use App\Models\Event;

Route::get('/', function () {
    $events = Event::all();
    return view('home', compact('events'));
})->name('home');

Route::get('/about', function () {
    return view('about');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [LoginController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [LoginController::class, 'register']);
});

Route::middleware('auth')->group(function () {
    Route::get('apprentice/list', [ApprenticeController::class, 'index'])->name('apprentice.index');
    Route::get('apprentice/create', [ApprenticeController::class, 'create'])->name('apprentice.create');
    Route::get('apprentice/{apprentice}', [ApprenticeController::class, 'show'])->name('apprentice.show');
    Route::post('apprentice/store', [ApprenticeController::class, 'store'])->name('apprentice.store');
    Route::get('apprentice/{apprentice}/edit', [ApprenticeController::class, 'edit'])->name('apprentice.edit');
    Route::put('apprentice/{apprentice}', [ApprenticeController::class, 'update'])->name('apprentice.update');
    Route::delete('apprentice/{apprentice}', [ApprenticeController::class, 'destroy'])->name('apprentice.destroy');

    Route::get('area/list', [AreaController::class, 'index'])->name('area.index');
    Route::get('area/create', [AreaController::class, 'create'])->name('area.create');
    Route::get('area/{area}', [AreaController::class, 'show'])->name('area.show');
    Route::post('area/store', [AreaController::class, 'store'])->name('area.store');
    Route::get('area/{area}/edit', [AreaController::class, 'edit'])->name('area.edit');
    Route::put('area/{area}', [AreaController::class, 'update'])->name('area.update');
    Route::delete('area/{area}', [AreaController::class, 'destroy'])->name('area.destroy');

    Route::get('computer/list', [ComputerController::class, 'index'])->name('computer.index');
    Route::get('computer/create', [ComputerController::class, 'create'])->name('computer.create');
    Route::get('computer/{computer}', [ComputerController::class, 'show'])->name('computer.show');
    Route::post('computer/store', [ComputerController::class, 'store'])->name('computer.store');
    Route::get('computer/{computer}/edit', [ComputerController::class, 'edit'])->name('computer.edit');
    Route::put('computer/{computer}', [ComputerController::class, 'update'])->name('computer.update');
    Route::delete('computer/{computer}', [ComputerController::class, 'destroy'])->name('computer.destroy');

    Route::get('course/list', [CourseController::class, 'index'])->name('course.index');
    Route::get('course/create', [CourseController::class, 'create'])->name('course.create');
    Route::get('course/{course}', [CourseController::class, 'show'])->name('course.show');
    Route::post('course/store', [CourseController::class, 'store'])->name('course.store');
    Route::get('course/{course}/edit', [CourseController::class, 'edit'])->name('course.edit');
    Route::put('course/{course}', [CourseController::class, 'update'])->name('course.update');
    Route::delete('course/{course}', [CourseController::class, 'destroy'])->name('course.destroy');

    Route::get('teacher/list', [TeacherController::class, 'index'])->name('teacher.index');
    Route::get('teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
    Route::get('teacher/{teacher}', [TeacherController::class, 'show'])->name('teacher.show');
    Route::post('teacher/store', [TeacherController::class, 'store'])->name('teacher.store');
    Route::get('teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
    Route::put('teacher/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
    Route::delete('teacher/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

    Route::get('training_center/list', [TrainingCenterController::class, 'index'])->name('training_center.index');
    Route::get('training_center/create', [TrainingCenterController::class, 'create'])->name('training_center.create');
    Route::get('training_center/{training_center}', [TrainingCenterController::class, 'show'])->name('training_center.show');
    Route::post('training_center/store', [TrainingCenterController::class, 'store'])->name('training_center.store');
    Route::get('training_center/{training_center}/edit', [TrainingCenterController::class, 'edit'])->name('training_center.edit');
    Route::put('training_center/{training_center}', [TrainingCenterController::class, 'update'])->name('training_center.update');
    Route::delete('training_center/{training_center}', [TrainingCenterController::class, 'destroy'])->name('training_center.destroy');

    Route::get('/event/create', [EventController::class, 'create'])->name('event.create');
    Route::post('/event/store', [EventController::class, 'store'])->name('event.store');
    Route::get('event/list', [EventController::class, 'index'])->name('event.index');
    Route::get('event/list', [EventController::class, 'index'])->name('event.show');
    Route::get('event/{event}/edit', [EventController::class, 'edit'])->name('event.edit');
    Route::put('event/{event}', [EventController::class, 'update'])->name('event.update');
    Route::delete('event/{event}', [EventController::class, 'destroy'])->name('event.destroy');

    Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
    Route::post('/user/store', [UserController::class, 'store'])->name('user.store');
    Route::get('/user/list', [UserController::class, 'index'])->name('user.index');
    Route::get('/user/{user}', [UserController::class, 'show'])->name('user.show');
    Route::get('/user/{user}/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::put('/user/{user}', [UserController::class, 'update'])->name('user.update');
    Route::delete('/user/{user}', [UserController::class, 'destroy'])->name('user.destroy');


    Route::get('/environment/create', [EnvironmentController::class, 'create'])->name('environment.create');
    Route::post('/environment/store', [EnvironmentController::class, 'store'])->name('environment.store');
    Route::get('/environment/list', [EnvironmentController::class, 'index'])->name('environment.index');
    Route::get('/environment/{environment}', [EnvironmentController::class, 'show'])->name('environment.show');
    Route::get('/environment/{environment}/edit', [EnvironmentController::class, 'edit'])->name('environment.edit');
    Route::put('/environment/{environment}', [EnvironmentController::class, 'update'])->name('environment.update');
    Route::delete('/environment/{environment}', [EnvironmentController::class, 'destroy'])->name('environment.destroy');


    Route::get('/admin/create', [AdminController::class, 'create'])->name('admin.create');
    Route::post('/admin/store', [AdminController::class, 'store'])->name('admin.store');
    Route::get('/admin/list', [AdminController::class, 'index'])->name('admin.index');
    Route::get('/admin/{admin}', [AdminController::class, 'show'])->name('admin.show');
    Route::get('/admin/{admin}/edit', [AdminController::class, 'edit'])->name('admin.edit');
    Route::put('/admin/{admin}', [AdminController::class, 'update'])->name('admin.update');
    Route::delete('/admin/{admin}', [AdminController::class, 'destroy'])->name('admin.destroy');


    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::get('/events/{event}', [EventController::class, 'show'])->name('event.show');

Route::get('/clear-session', function () {
    session()->flush();
    return redirect()->route('login');
});
