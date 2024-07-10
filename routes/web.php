<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\AdminAuth;

use App\Http\Controllers\Admin\Admin_AuthController;
use App\Http\Controllers\Admin\Admin_DashboardController;
use App\Http\Controllers\Admin\Admin_CollegeController;
use App\Http\Controllers\Admin\Admin_DepartmentController;
use App\Http\Controllers\Admin\Admin_StaffController;
use App\Http\Controllers\Admin\Admin_DeanController;
use App\Http\Controllers\Admin\Admin_MinistryController;



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
    return view('welcome');
})->name('welcome');



Route::get('/admin', [Admin_AuthController::class, 'index'])->name('admin.auth.index');
Route::post('/admin', [Admin_AuthController::class, 'login'])->name('admin.auth.login');



Route::prefix('admin')->middleware(['auth','admin'])->group(function(){
    
    Route::get('/dashboard', [Admin_DashboardController::class, 'index'])->name('admin.dashboard.index');
    Route::post('/logout', [Admin_AuthController::class, 'logout'])->name('admin.auth.logout');


    //college
    Route::get('/colleges', [Admin_CollegeController::class, 'index'])->name('admin.colleges.index');
    Route::get('/colleges/create', [Admin_CollegeController::class, 'create'])->name('admin.colleges.create');
    Route::post('colleges/store', [Admin_CollegeController::class, 'store'])->name('admin.colleges.store');


    // ministry
    Route::get('/ministries', [Admin_MinistryController::class, 'index'])->name('admin.ministries.index');


    Route::get('colleges/{college}/edit', [Admin_CollegeController::class, 'edit'])->name('admin.colleges.edit');
    Route::post('colleges/{college}/update', [Admin_CollegeController::class, 'update'])->name('admin.colleges.update');
    Route::delete('college/{college}/destroy', [Admin_CollegeController::class, 'destroy'])->name('admin.colleges.destroy');


    // Department
    Route::get('/departments', [Admin_DepartmentController::class, 'index'])->name('admin.departments.index');
    Route::get('departments/create', [Admin_DepartmentController::class, 'create'])->name('admin.departments.create');
    Route::post('departments/store', [Admin_DepartmentController::class, 'store'])->name('admin.departments.store');
    
    Route::get('departments/{department}/edit', [Admin_DepartmentController::class, 'edit'])->name('admin.departments.edit');
    Route::post('departments/{department}/update', [Admin_DepartmentController::class, 'update'])->name('admin.departments.update');

    Route::post('departments/destroy', [Admin_DepartmentController::class, 'destroy'])->name('admin.departments.destroy');


    // Staff
    Route::get('staff', [Admin_StaffController::class, 'index'])->name('admin.staff.index');
    Route::get('staff/create', [Admin_StaffController::class, 'create'])->name('admin.staff.create');
    Route::post('staff/store', [Admin_StaffController::class, 'store'])->name('admin.staff.store');

    Route::get('staff/{staff}/edit', [Admin_StaffController::class, 'edit'])->name('admin.staff.edit');
    Route::post('staff/{staff}/update', [Admin_StaffController::class, 'update'])->name('admin.staff.update');


    // Deans
    Route::get('deans', [Admin_DeanController::class, 'index'])->name('admin.deans.index');
    Route::get('dean/create', [Admin_DeanController::class, 'create'])->name('admin.deans.create');
    Route::post('dean/get_assigned_dean', [Admin_DeanController::class, 'get_assigned_dean'])->name('admin.deans.get_assigned_dean');

    Route::get('dean/assign_dean', [Admin_DeanController::class, 'assign_dean'])->name('admin.deans.assign_dean');
    Route::post('dean/assign_dean', [Admin_DeanController::class, 'store_assign_dean'])->name('admin.deans.store_assign_dean');
});



Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
