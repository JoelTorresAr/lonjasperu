<?php

$codigoProd = $_POST["codProd"];

require_once '../negocio/Producto.class.php';
$objProducto = new Producto();

try{
    $objProducto->setCodigoProducto($codigoProd);
    if($objProducto->eliminar()){
        echo "exito";
    }
} catch (Exception $ex) {
    
    header("HTTP/1.1 500");
    echo $exc->getMessage();

}