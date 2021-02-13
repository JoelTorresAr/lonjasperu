<?php

require_once '../negocio/Producto.class.php';

$codigo = $_POST["codProd"];

$objProducto = new Producto();
try {
    $resultado = $objProducto->leerDatos($codigo);
    echo json_encode($resultado);
}catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}




