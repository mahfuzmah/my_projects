<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');

// Open login/logout/register
$routes->get('/login', 'AuthController::login');
$routes->post('/process-login', 'AuthController::processLogin');
$routes->get('/logout', 'AuthController::logout');


// ✅ Admin-only: Employee management (protected by 'admin' filter)
$routes->group('employees', ['filter' => 'admin'], function($routes){
    $routes->get('/', 'Employee::index');
    $routes->get('create', 'Employee::create');
    $routes->post('store', 'Employee::store');
    $routes->get('edit/(:num)', 'Employee::edit/$1');
    $routes->post('update/(:num)', 'Employee::update/$1');
    $routes->get('delete/(:num)', 'Employee::delete/$1');
    $routes->get('register', 'AuthController::register');
    $routes->post('process-register', 'AuthController::processRegister');
    $routes->get('shifts', 'Shift::index');
    $routes->post('shifts/create', 'Shift::create');
});

// ✅ Authenticated user access: Attendance (employee or admin)
$routes->group('attendance', ['filter' => 'auth'], function($routes){
    $routes->get('/', 'AttendanceController::index');
    $routes->post('clock-in', 'AttendanceController::clockIn');
    $routes->post('clock-out/(:num)', 'AttendanceController::clockOut/$1');
});

$routes->get('attendance/report', 'AttendanceController::report', ['filter' => 'admin']);
$routes->get('admin/dashboard', 'AdminDashboard::index', ['filter' => 'admin']);
