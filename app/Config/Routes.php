<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

// Outlet
$routes->get('/outlet', 'Outlet::index');
$routes->get('/outlet/add', 'Outlet::addOutletView');
$routes->get('/outlet/(:any)', 'Outlet::updateOutletView/$1');
$routes->post('/addoutlet', 'Outlet::addOutlet', ["as" => "addoutlet"]);
$routes->post('/updateoutlet', 'Outlet::updateOutlet', ["as" => "updateoutlet"]);
$routes->delete('/outlet/(:any)', 'Outlet::deleteOutlet/$1');

// Barang
$routes->get('/barang', 'Barang::index');
$routes->get('/barang/add', 'Barang::addBarangView');
$routes->get('/barang/(:any)', 'Barang::updateBarangView/$1');
$routes->post('/addbarang', 'Barang::addBarang', ["as" => "addbarang"]);
$routes->post('/updatebarang', 'Barang::updateBarang', ["as" => "updatebarang"]);
$routes->delete('/barang/(:any)', 'Barang::deleteBarang/$1');

// Penjualan Header
$routes->get('/penjualan', 'Penjualan::index', ['as' => 'penjualan']);
$routes->get('/penjualan/detail/(:any)', 'Penjualan::detail/$1');
$routes->get('/penjualan/add', 'Penjualan::addPenjualanView');
$routes->post('/addpenjualan', 'Penjualan::addPenjualan', ["as" => "addpenjualan"]);

// Misc
$routes->get('/filteredbarangs/(:any)', 'Penjualan::getFilteredBarangs/$1');
$routes->get('/filteredbarangs', 'Penjualan::getFilteredBarangs');
