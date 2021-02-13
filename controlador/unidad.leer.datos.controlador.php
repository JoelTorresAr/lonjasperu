<?php

require_once '../negocio/Unidad.class.php';

$codigo = $_POST["codCargo"];

$objUnidad = new Unidad();
try {
    $resultado = $objUnidad->leerDatos($codigo);
    echo json_encode($resultado);
}catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
