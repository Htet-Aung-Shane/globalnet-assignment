<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});

#notactive
Route::get('/activate', function () {
    return view('activate');
})->name('notactive');

#notadmin
Route::get('/active/admin', function () {
    return view('user.activeadmin');
})->name('notadmin');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'active'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::middleware('auth','active')->group(function () {
    Route::get('/dashboard/student', [StudentController::class, 'index'])->name('student.list');
    Route::get('/dashboard/student/create', [StudentController::class, 'create'])->name('student.create');
    Route::get('/dashboard/student/edit', [StudentController::class, 'edit'])->name('student.edit');
    Route::patch('/dashboard/student/edit/action', [StudentController::class, 'update'])->name('student.edit.action');
    Route::get('/dashboard/student/delete', [StudentController::class, 'deleteAction'])->name('student.delete');
    Route::post('/dashboard/student/create/action', [StudentController::class, 'createAction'])->name('student.create.action');
});
Route::middleware('auth','active','admin')->group(function () {
    Route::get('/dashboard/user', [UserController::class, 'index'])->name('user.list');
    Route::get('/dashboard/user/create', [UserController::class, 'create'])->name('user.create');
    Route::get('/dashboard/user/edit', [UserController::class, 'edit'])->name('user.edit');
    Route::patch('/dashboard/user/edit/action', [UserController::class, 'update'])->name('user.edit.action');
    Route::get('/dashboard/user/delete', [UserController::class, 'deleteAction'])->name('user.delete');
    Route::post('/dashboard/user/create/action', [UserController::class, 'createAction'])->name('user.create.action');
  
});
require __DIR__.'/auth.php';
