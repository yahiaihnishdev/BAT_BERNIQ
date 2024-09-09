<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmpFamilyController;
use App\Http\Controllers\EmpDocumentController;
use App\Http\Controllers\EmpContactController;
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


// Route::resource('jobs', JobController::class);
Route::get('jobs/search', [JobController::class, 'search'])->name('jobs.search');

use App\Http\Controllers\UserTypeController;
use App\Http\Controllers\HolidayController;


// User Type routes
Route::get('/user_type', [UserTypeController::class, 'index'])->name('user_type.index');
Route::get('/user_type/create', [UserTypeController::class, 'create'])->name('user_type.create');
Route::post('/user_type', [UserTypeController::class, 'store'])->name('user_type.store');
Route::get('/user_type/{id}/edit', [UserTypeController::class, 'edit'])->name('user_type.edit');
Route::put('/user_type/{id}', [UserTypeController::class, 'update'])->name('user_type.update'); // This needs to be PUT
Route::delete('/user_type/{id}', [UserTypeController::class, 'delete'])->name('user_type.delete');
Route::get('/user_type/search', [UserTypeController::class, 'search'])->name('user_type.search');





// holiday routes

Route::get('/holidays', [HolidayController::class, 'index'])->name('holidays.index');
Route::get('/holidays/create', [HolidayController::class, 'create'])->name('holidays.create');
Route::post('/holidays', [HolidayController::class, 'store'])->name('holidays.store');
Route::get('/holidays/{id}/edit', [HolidayController::class, 'edit'])->name('holidays.edit');
Route::put('/holidays/{id}', [HolidayController::class, 'update'])->name('holidays.update');
Route::delete('/holidays/{id}', [HolidayController::class, 'delete'])->name('holidays.delete');
Route::get('/holidays/search', [HolidayController::class, 'search'])->name('holidays.search');
Route::get('holidays/export-pdf', [HolidayController::class, 'exportPDF'])->name('holidays.exportPDF');








// Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
// Route::get('/employees/create', [EmployeeController::class, 'create'])->name('employees.create');
// Route::post('/employees', [EmployeeController::class, 'store'])->name('employees.store');
// Route::get('/employees/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
// Route::put('/employees/{id}', [EmployeeController::class, 'update'])->name('employees.update');
// Route::delete('/employees/{id}', [EmployeeController::class, 'delete'])->name('employees.delete');

// Employee Routes
Route::prefix('employees')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('employees.index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('employees.create');
    Route::post('/', [EmployeeController::class, 'store'])->name('employees.store');
    Route::get('/{id}/edit', [EmployeeController::class, 'edit'])->name('employees.edit');
    Route::put('/{id}', [EmployeeController::class, 'update'])->name('employees.update');
    Route::delete('/{id}', [EmployeeController::class, 'delete'])->name('employees.delete');

    // Optional: Show delete confirmation page
    Route::get('/{id}/delete', [EmployeeController::class, 'showDelete'])->name('employees.showDelete');

    // Optional: Fetch employee name via AJAX or API
    Route::get('/{id}/name', [EmployeeController::class, 'fetchName'])->name('employees.fetchName');
    Route::get('/employees/export', [EmployeeController::class, 'export'])->name('employees.export');

});
