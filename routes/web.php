<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    JobController,
    DepartmentController,
    EmployeeController,
    EmpFamilyController,
    EmpDocumentController,
    EmpContactController,
    UserTypeController,
    HolidayController
};

// Admin Dashboard Route
Route::get('/admin', function () {
    return view('pages.dashboard.admin');
})->name('admin');

// Login Route
Route::get('/', function () {
    return view('login');
})->name('login');

// Department Routes
Route::prefix('departments')->group(function () {
    Route::get('/', [DepartmentController::class, 'index'])->name('index_department');
    Route::get('/search', [DepartmentController::class, 'search'])->name('search_department');
    Route::get('/create', [DepartmentController::class, 'create'])->name('create_department');
    Route::post('/store', [DepartmentController::class, 'store'])->name('store_department');
    Route::get('/edit/{id}', [DepartmentController::class, 'edit'])->name('edit_department');
    Route::put('/update/{id}', [DepartmentController::class, 'update'])->name('update_department');
    Route::delete('/delete/{id}', [DepartmentController::class, 'delete'])->name('delete_department');
});

// Job Routes
Route::resource('jobs', JobController::class)->except(['show']);
Route::get('/jobs/search', [JobController::class, 'search'])->name('jobs.search');

// User Type Routes
Route::prefix('user_type')->group(function () {
    Route::get('/', [UserTypeController::class, 'index'])->name('user_type.index');
    Route::get('/create', [UserTypeController::class, 'create'])->name('user_type.create');
    Route::post('/', [UserTypeController::class, 'store'])->name('user_type.store');
    Route::get('/{id}/edit', [UserTypeController::class, 'edit'])->name('user_type.edit');
    Route::put('/{id}', [UserTypeController::class, 'update'])->name('user_type.update');
    Route::delete('/{id}', [UserTypeController::class, 'delete'])->name('user_type.delete');
    Route::get('/search', [UserTypeController::class, 'search'])->name('user_type.search');
});

// Holiday Routes
Route::resource('holidays', HolidayController::class)->except(['show']);
Route::get('/holidays/search', [HolidayController::class, 'search'])->name('holidays.search');
Route::get('holidays/export-pdf', [HolidayController::class, 'exportPDF'])->name('holidays.exportPDF');

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

    // Employee Export
    Route::get('/export', [EmployeeController::class, 'export'])->name('employees.export');

    // Nested Employee Routes for Specific Employee Actions
    Route::get('/{emp_id}/family', [EmpFamilyController::class, 'index'])->name('employees.family');
    Route::get('/{emp_id}/emergency-contacts', [EmployeeController::class, 'emergencyContacts'])->name('employees.emergencyContacts');
    Route::get('/{emp_id}/documents', [EmployeeController::class, 'documents'])->name('employees.documents');
    Route::get('/{emp_id}/holidays', [EmployeeController::class, 'holidays'])->name('employees.holidays');
    Route::get('/{emp_id}/performance', [EmployeeController::class, 'performance'])->name('employees.performance');
    Route::get('/{emp_id}/salary', [EmployeeController::class, 'salary'])->name('employees.salary');
});

// Family Member Routes
Route::prefix('emp_family')->group(function () {
    Route::get('/', [EmpFamilyController::class, 'index'])->name('emp_family.index');
    Route::get('/create', [EmpFamilyController::class, 'create'])->name('emp_family.create');
    Route::post('/store', [EmpFamilyController::class, 'store'])->name('emp_family.store');
    Route::get('/edit/{id}', [EmpFamilyController::class, 'edit'])->name('emp_family.edit');
    Route::put('/update/{id}', [EmpFamilyController::class, 'update'])->name('emp_family.update');
    Route::put('/delete/{id}', [EmpFamilyController::class, 'delete'])->name('emp_family.delete');
});
