<?php // routes/breadcrumbs.php

// Note: Laravel will automatically resolve `Breadcrumbs::` without
// this import. This is nice for IDE syntax and refactoring.
use Diglactic\Breadcrumbs\Breadcrumbs;

// This import is also not required, and you could replace `BreadcrumbTrail $trail`
//  with `$trail`. This is nice for IDE type checking and completion.
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;

//Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Dashboard', route('home'));
});

// Clients
Breadcrumbs::for('clients', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Clients', route('users.list'));
});

Breadcrumbs::for('employees', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Employees', route('employees.list'));
});

Breadcrumbs::for('transactions', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Transactions', route('transactions.list'));
});

Breadcrumbs::for('accounts', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Accounts', route('accounts.list'));
});

Breadcrumbs::for('contact_persons', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Contacts', route('contactpersons.list'));
});


Breadcrumbs::for('unapproved_contacts', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Unapproved Contacts', route('unapprovecontactpersons.list'));
});

Breadcrumbs::for('trucks', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Fleet', route('trucks.list'));
});

Breadcrumbs::for('create_transaction', function (BreadcrumbTrail $trail) {
    $trail->parent('transactions');
    $trail->push('Create Transaction', route('store.transaction'));
});


Breadcrumbs::for('material_types', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Materials', route('material.types.list'));
});

Breadcrumbs::for('unapproved_clients', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Unapproved Clients', route('unapproveclients.list'));
});

Breadcrumbs::for('roles_and_permissions', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Roles & Permissions', route('roles.permissions'));
});


Breadcrumbs::for('locations', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Locations', route('locations.list'));
});

Breadcrumbs::for('reports', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('View Reports', route('reports'));
});
