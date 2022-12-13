<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;

use App\Http\Livewire\Admin\AttendeesList;
use App\Http\Controllers\AttendanceController;
use App\Http\Livewire\Admin\DiscountList;
use App\Http\Livewire\Admin\DashboardList;
use App\Http\Livewire\Admin\EmployeesList;
use App\Http\Controllers\EmployeeController;
use App\Http\Livewire\Admin\CentersList;
use App\Http\Livewire\Admin\DepartmentsList;
use App\Http\Livewire\Admin\PositionsList;
use App\Http\Livewire\Admin\VacationsList;
use App\Http\Livewire\Admin\TasksList;

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

Route::get('dashboard', DashboardList::class)->name('dashboard');

Route::get('attendees', AttendeesList::class)->name('attendees');
Route::post('/import',[AttendanceController::class,'import'])->name('import');  // Change name please

Route::get('discount', DiscountList::class)->name('discount');

Route::get('employees', EmployeesList::class)->name('employees');
Route::post('/import2',[EmployeeController::class,'import2'])->name('import2'); // Change name please

Route::get('centers', CentersList::class)->name('centers');
Route::get('departments', DepartmentsList::class)->name('departments');
Route::get('positions', PositionsList::class)->name('positions');

Route::get('vacations', VacationsList::class)->name('vacations');
Route::get('tasks', TasksList::class)->name('tasks');

