<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        $count = 0;

        $data[++$count] = [ "module" => "Material Type", "name" => "Add Material", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Material Type", "name" => "View Materials", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Material Type", "name" => "Update Material Type", "guard_name" => "web"];


        $data[++$count] = [ "module" => "Truck", "name" => "Add Truck", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Truck", "name" => "View Trucks", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Truck", "name" => "Update Truck", "guard_name" => "web"];


        $data[++$count] = [ "module" => "Location", "name" => "Add Category", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Location", "name" => "Add Location", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Location", "name" => "View Locations", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Location", "name" => "Update Location", "guard_name" => "web"];


        // $data[++$count] = [ "module" => "Client", "name" => "Add Client", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Client", "name" => "View Clients", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Client", "name" => "View Unapproved Clients", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Contacts", "name" => "View Contacts", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Contacts", "name" => "View Unapproved Contacts", "guard_name" => "web"];

        // $data[++$count] = [ "module" => "Client", "name" => "Update Client", "guard_name" => "web"];


        $data[++$count] = [ "module" => "Employee", "name" => "Add Employee", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Employee", "name" => "View Employees", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Employee", "name" => "Update Employee", "guard_name" => "web"];


        $data[++$count] = [ "module" => "Account", "name" => "Add Account", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Account", "name" => "View Accounts", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Account", "name" => "Update Account", "guard_name" => "web"];


        $data[++$count] = [ "module" => "Transaction", "name" => "Create Transaction", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Transaction", "name" => "View Transactions", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Transaction", "name" => "Update Transaction", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Transaction", "name" => "Process Transaction", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Transaction", "name" => "Print Ticket", "guard_name" => "web"];




        $data[++$count] = [ "module" => "Client", "name" => "Generate Weekly Invoice", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Roles & Permissions", "name" => "Add Role", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Roles & Permissions", "name" => "Update Role", "guard_name" => "web"];

        $data[++$count] = [ "module" => "Roles & Permissions", "name" => "Assign Role", "guard_name" => "web"];
        
        $data[++$count] = [ "module" => "Roles & Permissions", "name" => "Assign Permissions", "guard_name" => "web"];

        $data[++$count] = [ "module" => "User", "name" => "Change Password", "guard_name" => "web"];


        $data[++$count] = [ "module" => "User", "name" => "View Deactive User", "guard_name" => "web"];

        $data[++$count] = [ "module" => "User", "name" => "Approve Deactive User", "guard_name" => "web"];

        $data[++$count] = [ "module" => "User", "name" => "View Ticket Issues", "guard_name" => "web"];

        $data[++$count] = [ "module" => "User", "name" => "Report Ticket Issue", "guard_name" => "web"];

        Permission::insert($data);
    }
}
