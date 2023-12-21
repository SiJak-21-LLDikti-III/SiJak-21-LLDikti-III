<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'HomeController::index');
$routes->get('/layanan-pajak', 'LayananPajakController::index');

// Admin Pages
$routes->get('/dashboard', 'DashboardAdminController::index');
$routes->get('/bukti-potong', 'BuktiPotongController::index');
$routes->post('/excel/upload', 'BuktiPotongController::uploadExcel');

$routes->get('/pemotong-pajak', 'PemotongPajakController::index');
$routes->post('/pemotong-pajak/update/(:num)', 'PemotongPajakController::update/$1');
