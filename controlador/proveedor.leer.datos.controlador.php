<?php

require_once '../negocio/Proveedor.class.php';

$codigo = $_POST["codProv"];

$objProveedor = new Proveedor();
try {
    $resultado = $objProveedor->leerDatos($codigo);
    echo json_encode($resultado);
}catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}




