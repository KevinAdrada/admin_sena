<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\TrainingCenterController;
use App\Http\Controllers\ComputerController;
use App\Http\Controllers\ApprenticeController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\TeacherController;


Route::get('/', function () {
    return view('home');
});

Route::get('apprentice/list',[ApprenticeController::class,'index'])->name('apprentice.index');
Route::get('apprentice/create',[ApprenticeController::class,'create'])->name('apprentice.create');
Route::get('apprentice/{apprentice}',[ApprenticeController::class,'show'])->name('apprentice.show');
Route::post('apprentice/store',[ApprenticeController::class,'store'])->name('apprentice.store');
Route::get('apprentice/{apprentice}/edit',[ApprenticeController::class,'edit'])->name('apprentice.edit');
Route::put('apprentice/{apprentice}',[ApprenticeController::class,'update'])->name('apprentice.update');
Route::delete('apprentice/{apprentice}',[ApprenticeController::class,'destroy'])->name('apprentice.destroy');


Route::get('area/list',[AreaController::class,'index'])->name('area.index');
Route::get('area/create',[AreaController::class,'create'])->name('area.create');
Route::get('area/{area}',[AreaController::class,'show'])->name('area.show');
Route::post('area/store',[AreaController::class,'store'])->name('area.store');
Route::get('area/{area}/edit',[AreaController::class,'edit'])->name('area.edit');
Route::put('area/{area}',[AreaController::class,'update'])->name('area.update');
Route::delete('area/{area}',[AreaController::class,'destroy'])->name('area.destroy');


Route::get('computer/list',[ComputerController::class,'index'])->name('computer.index');
Route::get('computer/create',[ComputerController::class,'create'])->name('computer.create');
Route::get('computer/{computer}',[ComputerController::class,'show'])->name('computer.show');
Route::post('computer/store',[ComputerController::class,'store'])->name('computer.store');
Route::get('computer/{computer}/edit',[ComputerController::class,'edit'])->name('computer.edit');
Route::put('computer/{computer}',[ComputerController::class,'update'])->name('computer.update');
Route::delete('computer/{computer}',[ComputerController::class,'destroy'])->name('computer.destroy');


Route::get('course/list',[CourseController::class,'index'])->name('course.index');
Route::get('course/create',[CourseController::class,'create'])->name('course.create');
Route::get('course/{course}',[CourseController::class,'show'])->name('course.show');
Route::post('course/store',[CourseController::class,'store'])->name('course.store');
Route::get('course/{course}/edit',[CourseController::class,'edit'])->name('course.edit');
Route::put('course/{course}',[CourseController::class,'update'])->name('course.update');
Route::delete('course/{course}',[CourseController::class,'destroy'])->name('course.destroy');


Route::get('teacher/list',[TeacherController::class,'index'])->name('teacher.index');
Route::get('teacher/create',[TeacherController::class,'create'])->name('teacher.create');
Route::get('teacher/{teacher}',[TeacherController::class,'show'])->name('teacher.show');
Route::post('teacher/store',[TeacherController::class,'store'])->name('teacher.store');
Route::get('teacher/{teacher}/edit',[TeacherController::class,'edit'])->name('teacher.edit');
Route::put('teacher/{teacher}',[TeacherController::class,'update'])->name('teacher.update');
Route::delete('teacher/{teacher}',[TeacherController::class,'destroy'])->name('teacher.destroy');


Route::get('training_center/list',[TrainingCenterController::class,'index'])->name('training_center.index');
Route::get('training_center/create',[TrainingCenterController::class,'create'])->name('training_center.create');
Route::get('training_center/{training_center}',[TrainingCenterController::class,'show'])->name('training_center.show');
Route::post('training_center/store',[TrainingCenterController::class,'store'])->name('training_center.store');
Route::get('training_center/{training_center}/edit',[TrainingCenterController::class,'edit'])->name('training_center.edit');
Route::put('training_center/{training_center}',[TrainingCenterController::class,'update'])->name('training_center.update');
Route::delete('training_center/{training_center}',[TrainingCenterController::class,'destroy'])->name('training_center.destroy');



