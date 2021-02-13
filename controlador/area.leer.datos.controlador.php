<?php

require_once '../negocio/Area.class.php';

$codigo = $_POST["codArea"];

$objArea = new Area();
try {
    $resultado = $objArea->leerDatos($codigo);
    echo json_encode($resultado);
}catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}




