<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\CodeGeneratorController;

// // Route::get('path', function(){})

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/about', function () {
//     return view('about');
// });
// // Route::view("/about", 'about', ['name' => 'about-page']);
// // Route::redirect('/', '/about');;

Route::get('/admin', function () {
    return view('pages.dashboard.admin');
})->name('admin');
Route::get('/', function () {
    return view('login');
})->name('login');


Route::get('/departments', [DepartmentController::class, 'index'])->name('index_department');
Route::get('/search_department', [DepartmentController::class, 'search'])->name('search_department');
Route::get('/create_department', [DepartmentController::class, 'create'])->name('create_department');
Route::post('/store_department', [DepartmentController::class, 'store'])->name('store_department');
Route::get('/edit_department/{id}', [DepartmentController::class, 'edit'])->name('edit_department');
Route::put('/update_department/{id}', [DepartmentController::class, 'update'])->name('update_department');
Route::delete('/delete_department/{id}', [DepartmentController::class, 'delete'])->name('delete_department');



Route::get('/jobs', [JobController::class, 'index'])->name('jobs.index');
Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');
Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
Route::get('/jobs/{id}/edit', [JobController::class, 'edit'])->name('jobs.edit');
Route::put('/jobs/{id}', [JobController::class, 'update'])->name('jobs.update');
Route::delete('/jobs/{id}', [JobController::class, 'delete'])->name('jobs.delete');
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');


Route::resource('jobs', JobController::class);
Route::get('jobs/search', [JobController::class, 'search'])->name('jobs.search');
