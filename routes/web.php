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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users.list');
Route::get('trucks', [App\Http\Controllers\TruckController::class, 'index'])->name('trucks.list');

Route::get('employees', [App\Http\Controllers\UserController::class, 'viewAllEmployees'])->name('employees.list');
Route::match(['get','post'],'storeemployee', [App\Http\Controllers\UserController::class, 'storeEmployees'])->name('store.employee');

Route::get('rolespermissions', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.permissions');

Route::match(['get','post'],'storerole', [App\Http\Controllers\RoleController::class, 'storeRole'])->name('store.role');


Route::match(['get','post'],'updaterole', [App\Http\Controllers\RoleController::class, 'updateRole'])->name('update.role');


Route::match(['get','post'],'assignpermission', [App\Http\Controllers\RoleController::class, 'assignPermissionsToRole'])->name('assign.permissions');
