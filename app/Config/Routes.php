<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/index', 'Home::index');
$routes->get('/', 'Home::frontend');
$routes->get('/registrasi-pelayanan', 'DataAdministrasiController::registrasiPelayanan');
$routes->post('/registrasi-pelayanan/ceknik', 'DataAdministrasiController::cekNIK');
$routes->get('/informasi-pelayanan', 'Home::informasiPelayanan');
$routes->get('/login', 'Home::Login');
$routes->post('authentication', 'Home::cek_login');
$routes->get('/logout', 'Home::logout');

$routes->get('data_rekam_administrasi', 'DataRekamAdministrasiController::index');
$routes->get('data_rekam_administrasi/create', 'DataRekamAdministrasiController::create');
$routes->post('data_rekam_administrasi/store', 'DataRekamAdministrasiController::store');
$routes->get('data_rekam_administrasi/edit/(:alphanum)', 'DataRekamAdministrasiController::edit/$1');
$routes->post('data_rekam_administrasi/update/(:num)', 'DataRekamAdministrasiController::update/$1');
$routes->get('data_rekam_administrasi/delete/(:alphanum)', 'DataRekamAdministrasiController::delete/$1');


$routes->get('data_administrasi', 'DataAdministrasiController::index');
$routes->get('data_administrasi/report', 'DataAdministrasiController::report');
$routes->get('data_administrasi/create', 'DataAdministrasiController::create');
$routes->post('data_administrasi/refresh', 'DataAdministrasiController::refresh');
$routes->post('data_administrasi/store', 'DataAdministrasiController::store');
$routes->post('data_administrasi/pendaftaran', 'DataAdministrasiController::pendaftaran');
$routes->get('data_administrasi/edit/(:alphanum)', 'DataAdministrasiController::edit/$1');
$routes->post('data_administrasi/update/(:num)', 'DataAdministrasiController::update/$1');
$routes->post('data_administrasi/updatestatus/(:num)', 'DataAdministrasiController::updatestatus/$1');
$routes->get('data_administrasi/delete/(:alphanum)', 'DataAdministrasiController::delete/$1');
$routes->get('data_administrasi/xls', 'DataAdministrasiController::xls');
$routes->get('data_administrasi/pdf', 'DataAdministrasiController::pdf');
