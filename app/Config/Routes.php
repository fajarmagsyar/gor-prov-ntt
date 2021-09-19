<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'UserController::index');

//admin->auth
$routes->get('/goradm', 'AdminController::login');
$routes->get('/goradm/signin', 'AdminAuth::loginAuth');
$routes->get('/goradm/logout', 'AdminAuth::logout');

//admin->show
$routes->get('/goradm/dashboard', 'AdminController::dashboard', ['filter' => 'adminGuard']);
$routes->get('/goradm/pemesanan', 'AdminController::pemesanan', ['filter' => 'adminGuard']);
$routes->get('/goradm/gor', 'AdminController::gor', ['filter' => 'adminGuard']);

//admin->data manipulation
$routes->post('/goradm/tambahFasilitas', 'AdminController::tambahFasilitas', ['filter' => 'adminGuard']);
$routes->post('/goradm/editFasilitas', 'AdminController::editFasilitas', ['filter' => 'adminGuard']);
$routes->get('/goradm/hapusFasilitas/(:segment)', 'AdminController::hapusFasilitas/$1', ['filter' => 'adminGuard']);

$routes->post('/goradm/editGor', 'AdminController::editGor', ['filter' => 'adminGuard']);

$routes->post('/goradm/tambahTarif', 'AdminController::tambahTarif', ['filter' => 'adminGuard']);
$routes->post('/goradm/editTarif', 'AdminController::editTarif', ['filter' => 'adminGuard']);
$routes->get('/goradm/hapusTarif/(:segment)', 'AdminController::hapusTarif/$1', ['filter' => 'adminGuard']);

/*
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
