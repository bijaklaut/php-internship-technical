<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Outlet Dashboard
$routes->get('/outlet', 'Outlet::index');
$routes->get('/outlet/add', 'Outlet::addOutletView');
$routes->get('/outlet/(:any)', 'Outlet::updateOutletView/$1');
$routes->post('/addoutlet', 'Outlet::addOutlet', ["as" => "addoutlet"]);
$routes->post('/updateoutlet', 'Outlet::updateOutlet', ["as" => "updateoutlet"]);
$routes->delete('/outlet/(:any)', 'Outlet::deleteOutlet/$1');

$routes->get('/barang', 'Barang::index');
$routes->get('/barang/add', 'Barang::addBarangView');
$routes->get('/barang/(:any)', 'Barang::updateBarangView/$1');
$routes->post('/addbarang', 'Barang::addBarang', ["as" => "addbarang"]);
$routes->post('/updatebarang', 'Barang::updateBarang', ["as" => "updatebarang"]);
$routes->delete('/barang/(:any)', 'Barang::deleteBarang/$1');
