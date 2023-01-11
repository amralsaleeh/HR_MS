<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\AttendanceController;

use App\Http\Livewire\Admin\DashboardList;
use App\Http\Livewire\Admin\EmployeesList;
use App\Http\Livewire\Admin\AttendeesList;
use App\Http\Livewire\Admin\DiscountList;
use App\Http\Livewire\Admin\CentersList;
use App\Http\Livewire\Admin\DepartmentsList;
use App\Http\Livewire\Admin\PositionsList;
use App\Http\Livewire\Admin\VacationsList;

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

Route::get('dashboard', DashboardList::class)->name('dashboard');
Route::get('/', DashboardList::class)->name('dashboard');

Route::get('employees', EmployeesList::class)->name('employees');
Route::post('/import_employees',[EmployeeController::class,'import_employees'])->name('import_employees');

Route::get('attendees', AttendeesList::class)->name('attendees');
Route::post('/import_attendees',[AttendanceController::class,'import_attendees'])->name('import_attendees');

Route::get('discount', DiscountList::class)->name('discount');

Route::get('centers', CentersList::class)->name('centers');
Route::get('departments', DepartmentsList::class)->name('departments');
Route::get('positions', PositionsList::class)->name('positions');

Route::get('vacations', VacationsList::class)->name('vacations');
