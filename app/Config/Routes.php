<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/layanan-pajak', 'LayananPajakController::index');
$routes->get('/layanan-pajak/unduh', 'CetakController::index');
$routes->get('/layanan-pajak/unduh-biasa', 'CetakController::unduh');
$routes->get('/login', 'LoginController::index');

// Admin Pages
$routes->get('/dashboard', 'DashboardAdminController::index');
$routes->get('/bukti-potong', 'BuktiPotongController::index');
$routes->post('/excel/upload', 'BuktiPotongController::uploadExcel');
$routes->get('/bukti-potong/filterTanggal/(:num)', 'BuktiPotongController::fetchData/$1');
$routes->get('/editbuktipotong', 'EditBuktiPotongController::index');

$routes->get('/pemotong-pajak', 'PemotongPajakController::index');
$routes->post('/pemotong-pajak/update/(:num)', 'PemotongPajakController::update/$1');
$routes->get('/pemotong-pajak', 'PemotongPajakController::editForm');
$routes->group('', function ($routes) {

    // Login/out
    $routes->get('login', 'AuthController::login', ['as' => 'login']);
    $routes->post('login', 'AuthController::attemptLogin');
    $routes->get('logout', 'AuthController::logout');

    // Registration
    $routes->get('register', 'AuthController::register', ['as' => 'register']);
    $routes->post('register', 'AuthController::attemptRegister');
});