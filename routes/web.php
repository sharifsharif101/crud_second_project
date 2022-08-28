<?php

use App\Http\Controllers\EmployeeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Models\Employee;

Route::get('/',[EmployeeController::class,'index']);
Route::post('/store',[EmployeeController::class,'store'])->name('store');
Route::get('/fetch-all',[EmployeeController::class,'fetchAll'])->name('fetchAll');
Route::get('/edit',[EmployeeController::class,'edit'])->name('edit');
Route::post('/update',[EmployeeController::class,'update'])->name('update');














// Route::get('students',[StudentController::class,'index']);
// Route::get('fetch-student',[StudentController::class,'fetchstudent']);
// Route::post('students',[StudentController::class,'store'])->name('posts.store');
// Route::get('edit-student/{id}',[StudentController::class,'edit']);
// Route::put('update-student/{id}',[StudentController::class,'update']);
// Route::delete('delete-student/{id}',[StudentController::class,'destroy']);
 