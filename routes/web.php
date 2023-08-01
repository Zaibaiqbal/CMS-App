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



Route::post('userregister', [App\Http\Controllers\UserController::class, 'registerUser'])->name('user.register');

Route::group(['middleware' => ['auth']], function() {

    Route::get('/', function () {
    return view('home');
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth');

Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users.list')->middleware('permission:All|View Clients');

Route::get('trucks', [App\Http\Controllers\TruckController::class, 'index'])->name('trucks.list')->middleware('permission:All|View Trucks');

Route::get('employees', [App\Http\Controllers\UserController::class, 'viewAllEmployees'])->name('employees.list')->middleware('permission:All|View Employees');

Route::match(['get','post'],'storeemployee', [App\Http\Controllers\UserController::class, 'storeEmployees'])->name('store.employee')->middleware('permission:All|Add Employee');


Route::match(['get','post'],'storeclient', [App\Http\Controllers\UserController::class, 'storeClient'])->name('store.client')->middleware('permission:All|Add Client');


Route::match(['get','post'],'updateemployee', [App\Http\Controllers\UserController::class, 'updateEmployees'])->name('update.employee')->middleware('permission:All|Update Employee');

Route::get('rolespermissions', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.permissions')->middleware('permission:All|Roles & Permissions');

Route::match(['get','post'],'storerole', [App\Http\Controllers\RoleController::class, 'storeRole'])->name('store.role')->middleware('permission:All|Add Role');


Route::match(['get','post'],'updaterole', [App\Http\Controllers\RoleController::class, 'updateRole'])->name('update.role')->middleware('permission:All|Update Role');


Route::match(['get','post'],'assignpermission', [App\Http\Controllers\RoleController::class, 'assignPermissionsToRole'])->name('assign.permissions')->middleware('permission:All|Assign Permissions');


Route::match(['get','post'],'assignrole', [App\Http\Controllers\RoleController::class, 'assignRolesToUser'])->name('assign.roles')->middleware('permission:All|Assign Role');



Route::match(['get','post'],'storetruck', [App\Http\Controllers\TruckController::class, 'storeTruck'])->name('store.truck')->middleware('permission:All|Add Truck');

Route::match(['get','post'],'updatetruck', [App\Http\Controllers\TruckController::class, 'updateTruck'])->name('update.truck')->middleware('permission:All|Update Truck');



Route::get('transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.list')->middleware('permission:All|View Transactions');

Route::match(['get','post'],'storetransaction', [App\Http\Controllers\TransactionController::class, 'storeTransaction'])->name('store.transaction')->middleware('permission:All|Create Transaction');

Route::get('materialtypeslist', [App\Http\Controllers\MaterialTypeController::class, 'index'])->name('material.types.list')->middleware('permission:All|View Material Types');


Route::post('storematerialtype', [App\Http\Controllers\MaterialTypeController::class, 'storeMaterialType'])->name('store.materialtype')->middleware('permission:All|Add Material Type');

Route::match(['get','post'],'storeaccount', [App\Http\Controllers\AccountController::class, 'storeAccount'])->name('store.account')->middleware('permission:All|Add Account');

Route::get('accountslist', [App\Http\Controllers\AccountController::class, 'index'])->name('accounts.list')->middleware('permission:All|View Accounts');


Route::get('unapproveclients', [App\Http\Controllers\UserController::class, 'viewUnapprovedClients'])->name('unapproveclients.list')->middleware('permission:All');


Route::get('approveclient', [App\Http\Controllers\UserController::class, 'approveUser'])->name('approve.client')->middleware('permission:All');


Route::get('searchplateno', [App\Http\Controllers\TruckController::class, 'autoSearchPlateNo'])->name('searchplateno');


Route::get('searchclientbyname', [App\Http\Controllers\UserController::class, 'autoSearchByClientName'])->name('searchclientbyname');


Route::post('changepassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change.password')->middleware('permission:All|Change Password');

Route::match(['get','post'],'updatetransaction', [App\Http\Controllers\TransactionController::class, 'updateTransaction'])->name('update.transaction')->middleware('permission:All|Update Transaction');


});