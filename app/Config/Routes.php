<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'LayananPajakController::index');

$routes->get('/dashboard-admin', 'DashboardAdminController::index');
$routes->get('/bukti-potong', 'BuktiPotongController::index');