<?php

require_once '../negocio/Articulo.class.php';

$codigo = $_POST["p_codigo"];

$objArea = new Area();
try {
    $resultado = $objArea->leerDatos($codigo);
    echo json_encode($resultado);
    //print_r($resultado);
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}





