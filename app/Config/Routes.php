<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->post('/checkData', 'HomeController::checkData');
$routes->get('/layanan-pajak', 'LayananPajakController::index');
$routes->get('/layanan-pajak/unduh/(:segment)/(:segment)/(:segment)', 'LayananPajakController::unduh/$1/$2/$3');
$routes->post('/layanan-pajak/unggah', 'LayananPajakController::unggah');
$routes->get('/login', 'LoginController::index');


// Admin Pages
$routes->get('/dashboard', 'DashboardAdminController::index');
$routes->get('/bukti-potong', 'BuktiPotongController::index');
$routes->post('/excel/upload', 'BuktiPotongController::uploadExcel');
$routes->get('/bukti-potong/filterTanggal/(:num)', 'BuktiPotongController::fetchData/$1');
$routes->get('/editbuktipotong', 'EditBuktiPotongController::index');


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
