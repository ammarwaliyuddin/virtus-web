<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Login');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.



$routes->get('/', 'Login::index');
$routes->get('/logout', 'Login::logout');

$routes->get('/Dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/Dashboard2', 'Dashboard2::index', ['filter' => 'auth']);
$routes->get('/Dashboard2/(:segment)', 'Dashboard2::index/$1', ['filter' => 'auth']);

$routes->get('/Security', 'Security::index', ['filter' => 'auth']);
$routes->get('/Security_personil', 'Security::detail_personil', ['filter' => 'auth']);
$routes->get('/Security2', 'Security2::index', ['filter' => 'auth']);
$routes->delete('/Security/(:any)', 'Security::delete/$1', ['filter' => 'auth']);

$routes->get('/Shift', 'Shift::index', ['filter' => 'auth']);

$routes->get('/Location', 'Location::index', ['filter' => 'auth']);
$routes->get('/Jabatan', 'Jabatan::index', ['filter' => 'auth']);

// $routes->get('/Jabatan', 'Jabatan::index');
$routes->delete('/Jabatan/(:num)', 'Jabatan::delete/$1');
// $routes->get('/Jabatan/(:any)', 'Jabatan::index/$1');

// print dan cetak pdf jabatan 



$routes->get('/Role_user', 'Role_user::index', ['filter' => 'auth']);
$routes->delete('/Role_user/(:num)', 'Role_user::delete/$1', ['filter' => 'auth']);
$routes->get('/Role_user/(:any)', 'Role_user::index/$1', ['filter' => 'auth']);

$routes->get('/Tambah_role_user', 'Tambah_role_user::index', ['filter' => 'auth']);

// print user laporan
$routes->get('/User_reportpdf', 'User::reportpdf', ['filter' => 'auth']);


$routes->get('/Area', 'Area::index', ['filter' => 'auth']);
$routes->delete('/Area/(:any)', 'Area::delete/$1', ['filter' => 'auth']);
$routes->get('/Area/(:any)', 'Area::index/$1', ['filter' => 'auth']);

// area print pdf
$routes->get('/Area_reportpdf', 'Area::reportpdf', ['filter' => 'auth']);
$routes->get('/Area_exportexcel', 'Area::export_excel', ['filter' => 'auth']);


$routes->get('/Customer', 'Customer::index', ['filter' => 'auth']);
$routes->delete('/Customer/(:num)', 'Customer::delete/$1', ['filter' => 'auth']);
$routes->get('/Customer/(:any)', 'Customer::index/$1', ['filter' => 'auth']);
// customer print pdf
$routes->get('/Customer_reportpdf', 'Customer::reportpdf', ['filter' => 'auth']);


$routes->get('/User', 'User::index', ['filter' => 'auth']);
$routes->delete('/User/(:any)', 'User::delete/$1', ['filter' => 'auth']);
$routes->get('/User/(:any)', 'User::index/$1', ['filter' => 'auth']);

$routes->get('/Smartwatch', 'Smartwatch::index');
$routes->delete('/Smartwatch/(:num)', 'Smartwatch::delete/$1', ['filter' => 'auth']);
$routes->get('/Smartwatch/(:any)', 'Smartwatch::index/$1', ['filter' => 'auth']);
// print pdf
$routes->get('/Smartwatch_reportpdf', 'Smartwatch::reportpdf', ['filter' => 'auth']);

/**
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
