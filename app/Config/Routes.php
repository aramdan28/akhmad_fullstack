<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('sign-in', 'Home::sign_in');
$routes->get('sign-up', 'Home::sign_up');

$routes->post('register', 'AuthController::register');
$routes->post('login', 'AuthController::login');

$routes->get('doctorsall', 'Home::doctorsall');

$routes->group('administrator',   function ($routes) {
    $routes->get('', 'AdminController::index');
    $routes->get('dashboard', 'AdminController::index');
    $routes->get('patients', 'AdminController::managePatients');
    $routes->get('doctors', 'AdminController::manageDoctors');
    $routes->get('doctor-schedule', 'AdminController::manageDoctorSchedules');
    $routes->get('inspection-schedule', 'AdminController::manageInspectionSchedules');
});

$routes->group('api',  function ($routes) {
    $routes->resource('patients', ['filter' => 'jwt']);
    $routes->resource('doctors', ['filter' => 'jwt']);
    $routes->resource('doctor_schedule', ['filter' => 'jwt']);
    $routes->resource('inspection_schedule', ['filter' => 'jwt']);
    $routes->get('doctorsall', 'Doctors::doctorsall');
});
