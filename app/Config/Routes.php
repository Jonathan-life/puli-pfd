<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('reportes/formulario', 'ReporteController::formOpciones'); // Para mostrar formulario
$routes->post('reportes/generar', 'ReporteController::generarPorPublisher'); // Para generar PDF
  // Generar PDF filtrado
$routes->get('reportes/r1', 'ReporteController::getReport1');


$routes->get('reportes/r3', 'ReporteController::getReport3');
$routes->get('reportes/formulario-buscar', 'ReporteController::formularioBuscar');
$routes->get('reportes/buscar', 'ReporteController::buscarSuperheroPdf');
$routes->get('reportes/autocomplete', 'ReporteController::autocomplete');

;



