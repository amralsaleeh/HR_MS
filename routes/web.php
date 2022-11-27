<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\Admin\EmployeesList;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', AdminController::class)->name('dashboard');
Route::get('dashboard', AdminController::class)->name('dashboard');

Route::get('attendees', EmployeesList::class)->name('attendees');
Route::get('discount', EmployeesList::class)->name('discount');

Route::get('employees', EmployeesList::class)->name('employees');
Route::get('positions', EmployeesList::class)->name('positions');

Route::get('vacationsDaily', EmployeesList::class)->name('vacationsDaily');
Route::get('vacationsHourly', EmployeesList::class)->name('vacationsHourly');

Route::get('tasksDaily', EmployeesList::class)->name('tasksDaily');
Route::get('tasksHourly', EmployeesList::class)->name('tasksHourly');

Route::get('tasks', EmployeesList::class)->name('tasks');

