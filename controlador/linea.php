<?php

require_once '../negocio/Linea.class.php';

$objLinea = new Linea();
$registros = $objLinea->obtenerLineas();
/*$registros2 = $objLinea->obtenerLineas2();*/

echo '<pre>';
print_r($registros);
/*print_r($registros2);*/
echo '</pre>';