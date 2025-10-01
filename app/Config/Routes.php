<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Auth::login');
// Auth
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::loginProcess');
$routes->get('/logout', 'Auth::logout');

$routes->get('/dashboard', 'Dashboard::index');

$routes->group('user', function($routes) {
    $routes->get('users', 'Users::users');
    $routes->get('create_user', 'Users::createUser');
    $routes->post('store_user', 'Users::storeUser');
    $routes->get('edit_user/(:num)', 'Users::editUser/$1');
    $routes->post('update_user/(:num)', 'Users::updateUser/$1');
    $routes->get('delete_user/(:num)', 'Users::deleteUser/$1');
});

$routes->group('products', function($routes) {
    $routes->get('/', 'Products::index');
    $routes->get('create', 'Products::create');
    $routes->post('store', 'Products::store');
    $routes->get('edit/(:num)', 'Products::edit/$1');
    $routes->post('update/(:num)', 'Products::update/$1');
    $routes->get('delete/(:num)', 'Products::delete/$1');
});
