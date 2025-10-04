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
$routes->get('/home', 'Dashboard::home');

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
    $routes->post('delete/(:num)', 'Products::delete/$1');
    $routes->get('confirm-delete/(:num)', 'Products::confirmDelete/$1');
});

$routes->group('permintaan', function($routes) {
    $routes->get('/', 'Permintaan::index');
    $routes->get('create', 'Permintaan::create');
    $routes->post('store', 'Permintaan::store');
    $routes->get('detail/(:num)', 'Permintaan::detail/$1');
    $routes->post('batalkan/(:num)', 'Permintaan::batalkan/$1');
});

$routes->group('gudang', function($routes) {
    $routes->get('permintaan', 'GudangController::index');
    $routes->get('permintaan/detail/(:num)', 'GudangController::detailPermintaan/$1');
    $routes->post('permintaan/setujui/(:num)', 'GudangController::setujui/$1');
    $routes->post('permintaan/tolak/(:num)', 'GudangController::tolak/$1');
});