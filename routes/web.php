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

    Route::get('/', function () {
        return redirect('/home');
    });
    
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('auth','verifyrole');
    
    
Route::get('users', [App\Http\Controllers\UserController::class, 'index'])->name('users.list')->middleware('auth','permission:All|View Clients');

Route::get('trucks', [App\Http\Controllers\TruckController::class, 'index'])->name('trucks.list')->middleware('auth','permission:All|View Trucks');

Route::get('employees', [App\Http\Controllers\UserController::class, 'viewAllEmployees'])->name('employees.list')->middleware('auth','permission:All|View Employees');

Route::match(['get','post'],'storeemployee', [App\Http\Controllers\UserController::class, 'storeEmployees'])->name('store.employee')->middleware('permission:All|Add Employee');


Route::match(['get','post'],'storeclient', [App\Http\Controllers\UserController::class, 'storeClient'])->name('store.client')->middleware('auth','permission:All|Add Client');


Route::match(['get','post'],'updateemployee', [App\Http\Controllers\UserController::class, 'updateEmployee'])->name('update.employee')->middleware('auth','permission:All|Update Employee');

Route::get('rolespermissions', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.permissions')->middleware('auth','permission:All|Roles & Permissions');

Route::match(['get','post'],'storerole', [App\Http\Controllers\RoleController::class, 'storeRole'])->name('store.role')->middleware('auth','permission:All|Add Role');


Route::match(['get','post'],'updaterole', [App\Http\Controllers\RoleController::class, 'updateRole'])->name('update.role')->middleware('auth','permission:All|Update Role');


Route::match(['get','post'],'assignpermission', [App\Http\Controllers\RoleController::class, 'assignPermissionsToRole'])->name('assign.permissions')->middleware('auth','permission:All|Assign Permissions');


Route::match(['get','post'],'assignrole', [App\Http\Controllers\RoleController::class, 'assignRolesToUser'])->name('assign.roles')->middleware('auth','permission:All|Assign Role');

Route::match(['get','post'],'storetruck', [App\Http\Controllers\TruckController::class, 'storeTruck'])->name('store.truck')->middleware('auth','permission:All|Add Truck');

Route::match(['get','post'],'updatetruck', [App\Http\Controllers\TruckController::class, 'updateTruck'])->name('update.truck')->middleware('auth','permission:All|Update Truck');

Route::get('transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.list')->middleware('auth','permission:All|View Transactions');

Route::match(['get','post'],'storetransaction', [App\Http\Controllers\TransactionController::class, 'storeTransaction'])->name('store.transaction')->middleware('auth','permission:All|Create Transaction');

Route::get('materialtypeslist', [App\Http\Controllers\MaterialTypeController::class, 'index'])->name('material.types.list')->middleware('auth','permission:All|View Material Types');


Route::post('storematerialtype', [App\Http\Controllers\MaterialTypeController::class, 'storeMaterialType'])->name('store.materialtype')->middleware('auth','permission:All|Add Material Type');

Route::match(['get','post'],'updatematerialtype', [App\Http\Controllers\MaterialTypeController::class, 'updateMaterialType'])->name('update.materialtype')->middleware('auth','permission:All|Update Material Type');

Route::get('materialratelist', [App\Http\Controllers\MaterialTypeController::class, 'viewMaterialList'])->name('material.rate.list')->middleware('auth','permission:All|View Material Types');


Route::post('storematerialrate', [App\Http\Controllers\MaterialTypeController::class, 'storeMaterialRate'])->name('store.materialrate')->middleware('auth','permission:All|Add Material Type');

Route::match(['get','post'],'storeaccount', [App\Http\Controllers\AccountController::class, 'storeAccount'])->name('store.account')->middleware('auth','permission:All|Add Account');

Route::get('accountslist', [App\Http\Controllers\AccountController::class, 'index'])->name('accounts.list')->middleware('auth','permission:All|View Accounts');


Route::get('unapproveclients', [App\Http\Controllers\UserController::class, 'viewUnapprovedClients'])->name('unapproveclients.list')->middleware('auth','permission:All');

Route::get('contactpersons', [App\Http\Controllers\UserController::class, 'viewContactPersons'])->name('contactpersons.list')->middleware('auth','permission:All|View Contact Persons');


Route::get('unapprovecontactpersons', [App\Http\Controllers\UserController::class, 'viewUnapprovedContactPersons'])->name('unapprovecontactpersons.list')->middleware('auth','permission:All|View Unapprove Contact Persons');


Route::match(['post','get'],'approveuser', [App\Http\Controllers\UserController::class, 'approveUser'])->name('approve.user')->middleware('auth','permission:All');


Route::match(['post','get'],'approvecontactperson', [App\Http\Controllers\UserController::class, 'approveContactPerson'])->name('approve.cotactperson')->middleware('auth','permission:All');


Route::get('searchplateno', [App\Http\Controllers\TruckController::class, 'autoSearchPlateNo'])->name('searchplateno');


Route::get('searchclientbyname', [App\Http\Controllers\UserController::class, 'autoSearchByClientName'])->name('searchclientbyname');


Route::post('changepassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change.password')->middleware('auth','permission:All|Change Password');

Route::match(['get','post'],'updatetransaction', [App\Http\Controllers\TransactionController::class, 'updateTransaction'])->name('update.transaction')->middleware('auth','permission:All|Update Transaction');


Route::get('loadnotification',[App\Http\Controllers\NotificationController::class, 'loadNotifications'])->name('loadnotification')->middleware('auth','permission:All');

Route::get('seennotification',[App\Http\Controllers\NotificationController::class, 'seenNotification'])->name('seennotification')->middleware('auth','permission:All');

Route::get('appearnotification',[App\Http\Controllers\NotificationController::class, 'appearNotification'])->name('appearnotification')->middleware('auth','permission:All');

Route::get('clientaccountlist',[App\Http\Controllers\UserAccountController::class, 'getClientAccountList'])->name('clientaccountlist')->middleware('auth','permission:All|Create Transaction');


Route::match(['get','post'],'viewdeactiveusers', [App\Http\Controllers\UserController::class, 'viewDeactiveUsers'])->name('viewdeactiveusers')->middleware('auth','permission:All|View Deactive User');

Route::get('approverdeactive', [App\Http\Controllers\UserController::class, 'approveRequestToDeactiveUser'])->name('approverdeactive')->middleware('auth','permission:All|Approve Deactive User');

// CLIENT ROUTES


Route::get('clientdashboard', function () {
    return view('clients.dashboard');
})->name('clientdashboard')->middleware('auth');

Route::get('clienttrucks', [App\Http\Controllers\TruckController::class, 'clientTruckList'])->name('client.trucks')->middleware('auth');

Route::get('clienttransactions', [App\Http\Controllers\TransactionController::class, 'clientTransactionList'])->name('client.transactions')->middleware('auth');

Route::get('clientaccounts', [App\Http\Controllers\AccountController::class, 'clientAccountList'])->name('client.accounts')->middleware('auth');

Route::get('deactiveuser', [App\Http\Controllers\UserController::class, 'deactiveUser'])->name('deactive.user')->middleware('auth');

Route::match(['get','post'],'contactpersonlist', [App\Http\Controllers\UserController::class, 'getContactPersonList'])->name('contactperson.list')->middleware('auth');


Route::match(['get','post'],'storeclienttruck', [App\Http\Controllers\TruckController::class, 'storeTruck'])->name('store.clienttruck')->middleware('auth');

Route::match(['get','post'],'requestcontactperson', [App\Http\Controllers\UserController::class, 'requestContactPerson'])->name('request.contactperson')->middleware('auth');


// END CLIENT ROUTES
