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

$routes->group('api', ['filter' => 'jwtauth'], function ($routes) {
    $routes->resource('patients');
    $routes->resource('doctors');
    $routes->resource('doctor_schedule');
    $routes->resource('inspection_schedule');
});
