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

Route::match(['get','post'],'storetruck', [App\Http\Controllers\TruckController::class, 'storeTruck'])->name('store.truck')->middleware('auth','permission:All|Add Fleet');

Route::match(['get','post'],'updatetruck', [App\Http\Controllers\TruckController::class, 'updateTruck'])->name('update.truck')->middleware('auth','permission:All|Update Fleet');

Route::get('transactions', [App\Http\Controllers\TransactionController::class, 'index'])->name('transactions.list')->middleware('auth','permission:All|View Transactions');

Route::match(['get','post'],'storetransaction', [App\Http\Controllers\TransactionController::class, 'storeTransaction'])->name('store.transaction')->middleware('auth','permission:All|Create Transaction');

Route::get('materialtypeslist', [App\Http\Controllers\MaterialTypeController::class, 'index'])->name('material.types.list')->middleware('auth','permission:All|View Materials');


Route::post('storematerialtype', [App\Http\Controllers\MaterialTypeController::class, 'storeMaterialType'])->name('store.materialtype')->middleware('auth','permission:All|Add Material');

Route::match(['get','post'],'updatematerialtype', [App\Http\Controllers\MaterialTypeController::class, 'updateMaterialType'])->name('update.materialtype')->middleware('auth','permission:All|Update Material Type');

Route::get('materialratelist', [App\Http\Controllers\MaterialTypeController::class, 'viewMaterialList'])->name('material.rate.list')->middleware('auth','permission:All|View Materials');


Route::post('storematerialrate', [App\Http\Controllers\MaterialTypeController::class, 'storeMaterialRate'])->name('store.materialrate')->middleware('auth','permission:All|Add Material');

Route::match(['get','post'],'updatematerialrate', [App\Http\Controllers\MaterialTypeController::class, 'updateMaterialRate'])->name('update.materialrate')->middleware('auth','permission:All|Update Material Rate');

// this request will be enerated by only client 

Route::match(['get','post'],'storeaccount', [App\Http\Controllers\AccountController::class, 'storeAccount'])->name('store.account')->middleware('auth');

Route::get('accountslist', [App\Http\Controllers\AccountController::class, 'index'])->name('accounts.list')->middleware('auth','permission:All|View Accounts');


Route::get('unapproveclients', [App\Http\Controllers\UserController::class, 'viewUnapprovedClients'])->name('unapproveclients.list')->middleware('auth','permission:All|View Unapproved Clients');

Route::get('contactpersons', [App\Http\Controllers\UserController::class, 'viewContactPersons'])->name('contactpersons.list')->middleware('auth','permission:All|View Contacts');


Route::get('unapprovecontactpersons', [App\Http\Controllers\UserController::class, 'viewUnapprovedContactPersons'])->name('unapprovecontactpersons.list')->middleware('auth','permission:All|View Unapproved Contacts');


Route::match(['post','get'],'approveuser', [App\Http\Controllers\UserController::class, 'approveUser'])->name('approve.user')->middleware('auth','permission:All');


Route::match(['post','get'],'approvecontactperson', [App\Http\Controllers\UserController::class, 'approveContactPerson'])->name('approve.cotactperson')->middleware('auth','permission:All');


Route::get('searchplateno', [App\Http\Controllers\TruckController::class, 'autoSearchPlateNo'])->name('searchplateno');

Route::get('autosearchtruck', [App\Http\Controllers\TruckController::class, 'autoSearchTruckInfo'])->name('autosearchtruck');


Route::get('searchclientbyname', [App\Http\Controllers\TransactionController::class, 'autoSearchByClientName'])->name('searchclientbyname');


Route::post('changepassword', [App\Http\Controllers\UserController::class, 'changePassword'])->name('change.password')->middleware('auth','permission:All|Change Password');

Route::match(['get','post'],'processtransaction', [App\Http\Controllers\TransactionController::class, 'processTransaction'])->name('process.transaction')->middleware('auth','permission:All|Update Transaction');

Route::match(['get','post'],'updatetransaction', [App\Http\Controllers\TransactionController::class, 'updateTransaction'])->name('update.transaction')->middleware('auth','permission:All|Update Transaction');


Route::get('loadnotification',[App\Http\Controllers\NotificationController::class, 'loadNotifications'])->name('loadnotification')->middleware('auth','permission:All');

Route::get('seennotification',[App\Http\Controllers\NotificationController::class, 'seenNotification'])->name('seennotification')->middleware('auth','permission:All');

Route::get('appearnotification',[App\Http\Controllers\NotificationController::class, 'appearNotification'])->name('appearnotification')->middleware('auth','permission:All');

Route::get('getclientaccountlist',[App\Http\Controllers\UserAccountController::class, 'getClientAccountList'])->name('getclientaccountlist')->middleware('auth');


Route::match(['get','post'],'viewdeactiveusers', [App\Http\Controllers\UserController::class, 'viewDeactiveUsers'])->name('viewdeactiveusers')->middleware('auth','permission:All|View Deactive User');

Route::get('approverdeactive', [App\Http\Controllers\UserController::class, 'approveRequestToDeactiveUser'])->name('approverdeactive')->middleware('auth','permission:All|Approve Deactive User');


Route::get('locations', [App\Http\Controllers\LocationController::class, 'index'])->name('locations.list')->middleware('auth','permission:All|View Locations');


Route::match(['get','post'],'storecategory', [App\Http\Controllers\LocationController::class, 'storeCategory'])->name('store.category')->middleware('auth','permission:All|Add Category');


Route::match(['get','post'],'storelocation', [App\Http\Controllers\LocationController::class, 'storeLocation'])->name('store.location')->middleware('auth','permission:All|Add Location');

Route::match(['get','post'],'transactioninvoice', [App\Http\Controllers\TransactionController::class, 'printTransactionInvoice'])->name('transaction.invoice')->middleware('auth','permission:All|Print Ticket');


Route::get('materialinfo', [App\Http\Controllers\MaterialTypeController::class, 'getMaterialInfo'])->name('materialinfo')->middleware('auth');

Route::get('accountrequests', [App\Http\Controllers\AccountController::class, 'viewAccountRequests'])->name('accountrequests')->middleware('auth');


Route::get('updateaccountstatus', [App\Http\Controllers\AccountController::class, 'updateAccountStatus'])->name('updateaccountstatus')->middleware('auth');


Route::get('accountinfo', [App\Http\Controllers\AccountController::class, 'getAccountInfo'])->name('accountinfo')->middleware('auth');

Route::get('clientaccountlist', [App\Http\Controllers\TruckController::class, 'getClientAccount'])->name('clientaccountlist')->middleware('auth');

Route::get('materialwisestats', [App\Http\Controllers\HomeController::class, 'getMaterialWiseStats'])->name('materialwisestats')->middleware('auth');


Route::match(['post','get'],'importclients', [App\Http\Controllers\ImportController::class, 'importClientData'])->name('import.clients')->middleware('auth','permission:All');


Route::match(['post','get'],'importaccounts', [App\Http\Controllers\ImportController::class, 'importAccountsData'])->name('import.accounts')->middleware('auth','permission:All');

Route::match(['post','get'],'importtrucks', [App\Http\Controllers\ImportController::class, 'importTrucksData'])->name('import.trucks')->middleware('auth','permission:All');


Route::get('sendemployeedailyprogress', [App\Http\Controllers\UserController::class, 'sendEmployeeDailyProgress'])->name('sendemployeedailyprogress')->middleware('auth');

Route::get('viewemployeeprogress', [App\Http\Controllers\UserController::class, 'viewEmployeeDailyProgress'])->name('viewemployeeprogress')->middleware('auth');


Route::get('printemployeeprogress', [App\Http\Controllers\UserController::class, 'printEmployeeDailyProgress'])->name('printemployeeprogress')->middleware('auth');

Route::get('latestdashboardstats', [App\Http\Controllers\HomeController::class, 'showLatestDashboardStats'])->name('latestdashboardstats')->middleware('auth');

Route::match(['get','post'],'generateweeklyinvoice', [App\Http\Controllers\ReportController::class, 'generateWeeklyInvoice'])->name('generateweeklyinvoice')->middleware('auth','permission:All|Generate Weekly Invoice');


Route::get('rateslab', [App\Http\Controllers\MaterialTypeController::class, 'viewRateSlab'])->name('rateslab')->middleware('auth','permission:All');


Route::get('usersettings', [App\Http\Controllers\HomeController::class, 'viewSetting'])->name('usersettings')->middleware('auth','permission:All|Change Password');


Route::match(['get','post'],'storesurcharge', [App\Http\Controllers\HomeController::class, 'storeSurcharge'])->name('store.surcharge')->middleware('auth','permission:All');

Route::get('surchargeinfo', [App\Http\Controllers\HomeController::class, 'surcharge'])->name('surchargeinfo')->middleware('auth','permission:All|Add Surcharge Hst');


// Ticket Issue Routes

Route::post('ticketissue', [App\Http\Controllers\HomeController::class, 'storeTicketIssue'])->name('ticketissue')->middleware('auth','permission:All|Report Ticket Issue');


Route::match(['get','post'],'ticketissue', [App\Http\Controllers\HomeController::class, 'storeTicketIssue'])->name('ticketissue')->middleware('auth','permission:All|Ticket Issue');


Route::get('autosearchticketnumber', [App\Http\Controllers\TransactionController::class, 'autoSearchTicketNumber'])->name('autosearchticketnumber');


Route::get('viewticketissues', [App\Http\Controllers\HomeController::class, 'viewTicketIssues'])->name('viewticketissues')->middleware('auth','permission:All|View Ticket Issues');

Route::get('dailycustomerreport', [App\Http\Controllers\ReportController::class, 'viewDailyCustomerReport'])->name('dailycustomerreport')->middleware('auth','permission:All|View Daily Customer Activity');


Route::get('weeklycustomerreport', [App\Http\Controllers\ReportController::class, 'viewWeeklyCustomerReport'])->name('weeklycustomerreport')->middleware('auth','permission:All|View Weekly Customer Activity');

Route::match(['get','post'],'clientgroupreport', [App\Http\Controllers\ReportController::class, 'clientGroupReport'])->name('clientgroupreport')->middleware('auth','permission:All|View Client Group Report');


Route::post('tableview',[App\Http\Controllers\TransactionController::class, 'tableViewSession'])->name('tableview')->middleware('auth');


Route::get('voidtransaction',[App\Http\Controllers\TransactionController::class, 'voidTransaction'])->name('void.transaction')->middleware('auth');

// Ticket Route End


Route::get('reports', [App\Http\Controllers\ReportController::class, 'index'])->name('reports')->middleware('auth','permission:All|View Reports');
// CLIENT ROUTES


Route::get('clientdashboard', function () {
    return view('clients.dashboard');
})->name('clientdashboard')->middleware('auth');

Route::get('clienttrucks', [App\Http\Controllers\TruckController::class, 'clientTruckList'])->name('client.trucks')->middleware('auth');

Route::get('clienttransactions', [App\Http\Controllers\TransactionController::class, 'clientTransactionList'])->name('client.transactions')->middleware('auth');

Route::get('clientaccounts', [App\Http\Controllers\AccountController::class, 'clientAccountList'])->name('client.accounts')->middleware('auth');

Route::get('assignaccountslist', [App\Http\Controllers\AccountController::class, 'assignAccountList'])->name('assignaccountslist')->middleware('auth');

Route::get('deactiveuser', [App\Http\Controllers\UserController::class, 'deactiveUser'])->name('deactive.user')->middleware('auth');

Route::match(['get','post'],'contactpersonlist', [App\Http\Controllers\UserController::class, 'getContactPersonList'])->name('contactperson.list')->middleware('auth');


Route::match(['get','post'],'storeclienttruck', [App\Http\Controllers\TruckController::class, 'storeTruck'])->name('store.clienttruck')->middleware('auth');

Route::match(['get','post'],'requestcontactperson', [App\Http\Controllers\UserController::class, 'requestContactPerson'])->name('request.contactperson')->middleware('auth');


Route::match(['get','post'],'assignaccount', [App\Http\Controllers\AccountController::class, 'assignAccount'])->name('assign.account')->middleware('auth');


Route::match(['get','post'],'unapprovedaccounts', [App\Http\Controllers\AccountController::class, 'viewUnapprovedAccountAssignment'])->name('unapprovedaccounts')->middleware('auth');

Route::match(['get','post'],'clientsummary', [App\Http\Controllers\UserController::class, 'viewClientSummary'])->name('client.summary')->middleware('auth','permission:All|View Client Summary');

// END CLIENT ROUTES
