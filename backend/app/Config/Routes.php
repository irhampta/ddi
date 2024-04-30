<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->group('api/v1', null, function ($routes) {

    // $routes->post('user/register', 'Api\User::register');
    // $routes->post('user/login', 'Api\User::login');
    // $routes->post('user/logout', 'Api\User::logout');

    $routes->resource('pegawai', ['controller' => 'Api\Pegawai']);
});