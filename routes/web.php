<?php

use Illuminate\Support\Facades\Route;

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
Auth::routes();



Route::group(['middleware' => ['auth']], function() {

    Route::get('/', function () {
    return view('home');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users.list')->middleware('permission:All|View Clients');

Route::get('trucks', [App\Http\Controllers\TruckController::class, 'index'])->name('trucks.list')->middleware('permission:All|View Trucks');

Route::get('employees', [App\Http\Controllers\UserController::class, 'viewAllEmployees'])->name('employees.list')->middleware('permission:All|View Employees');

Route::match(['get','post'],'storeemployee', [App\Http\Controllers\UserController::class, 'storeEmployees'])->name('store.employee')->middleware('permission:All|Store Employee');

Route::match(['get','post'],'updateemployee', [App\Http\Controllers\UserController::class, 'updateEmployees'])->name('update.employee')->middleware('permission:All|Update Employee');

Route::get('rolespermissions', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.permissions')->middleware('permission:All|Roles & Permissions');

Route::match(['get','post'],'storerole', [App\Http\Controllers\RoleController::class, 'storeRole'])->name('store.role')->middleware('permission:All|Store Role');


Route::match(['get','post'],'updaterole', [App\Http\Controllers\RoleController::class, 'updateRole'])->name('update.role')->middleware('permission:All|Update Role');


Route::match(['get','post'],'assignpermission', [App\Http\Controllers\RoleController::class, 'assignPermissionsToRole'])->name('assign.permissions')->middleware('permission:All|Assign Permissions');


Route::match(['get','post'],'assignrole', [App\Http\Controllers\RoleController::class, 'assignRolesToUser'])->name('assign.roles')->middleware('permission:All|Assign Role');



Route::match(['get','post'],'storetruck', [App\Http\Controllers\TruckController::class, 'storeTruck'])->name('store.truck')->middleware('permission:All|Store Truck');

Route::match(['get','post'],'updatetruck', [App\Http\Controllers\TruckController::class, 'updateTruck'])->name('update.truck')->middleware('permission:All|Update Truck');



Route::get('transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.list')->middleware('permission:All|View Transactions');

});