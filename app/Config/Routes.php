<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('estudiantes', 'Estudiantes::index');
$routes->get('detalles/(:num)', 'DetallesEvt::index/$1');


$routes->get('historial', 'Historial::index');
$routes->post('historial/eliminar/(:num)', 'Historial::eliminar/$1');


$routes->get('formatos', 'Formatos::index');

$routes->get('docentes', 'Docentes::index');
$routes->get('/getAcademias', 'Docentes::getAcademias');

$routes->get('proximos', 'Proximos::index');
$routes->get('proximos/eliminarEvento/(:num)', 'Proximos::eliminarEvento/$1');
$routes->post('proximos/editarEvento', 'Proximos::editarEvento');

$routes->get('importar', 'Importar::index');
$routes->post('importar/estudiantes', 'Importar::estudiantes');
$routes->post('importar/docentes', 'Importar::docentes');

$routes->get('principal', 'Principal::index');
$routes->post('principal/insertarEvento', 'Principal::insertarEvento');

$routes->get('/', 'Login::index');
$routes->post('auth', 'Login::auth');
$routes->get('logout', 'Login::logout');