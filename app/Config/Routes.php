<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->setAutoRoute(true);

$routes->get('/', 'Home::index');
$routes->get('auth/halamanlogin', 'Auth::halamanlogin');
$routes->get('auth/halamanregister', 'Auth::halamanregister');


$routes->post('auth/register', 'Auth::register');
$routes->post('auth/login', 'Auth::login');
$routes->get('auth/logout', 'Auth::logout');

$routes->get('/admin', 'Admin::index', ['filter' => 'role']);
$routes->get('admin/listuser', 'Admin::listuser', ['filter' => 'role']);
$routes->get('admin/listbarang', 'Admin::listbarang', ['filter' => 'role']);
$routes->get('admin/formtambah', 'Admin::tambahbarang', ['filter' => 'role']);
$routes->get('/listbarang', 'Admin::listbarang', ['filter' => 'role']);
$routes->get('/listbarang', 'Admin::listbarang', ['filter' => 'role']);
$routes->get('admin/profile', 'Admin::profile', ['filter' => 'role']);

$routes->post('keranjang/add/(:segment)', 'Keranjang::add/$1');
$routes->post('keranjang/', 'Keranjang::index');
$routes->get('datakeranjang', 'Datakeranjang::index');

$routes->get('admin/(:segment)', 'Admin::detail/$1', ['filter' => 'role']);
$routes->get('admin/edit/(:segment)', 'Admin::edit/$1', ['filter' => 'role']);
$routes->delete('admin/delete/(:num)', 'Admin::delete/$1', ['filter' => 'role']);
$routes->post('/admin/save', 'Admin::save', ['filter' => 'role']);
