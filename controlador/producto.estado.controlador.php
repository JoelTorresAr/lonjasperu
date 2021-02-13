<?php

$codigoProd = $_POST["codProd"];

require_once '../negocio/Producto.class.php';
$objProducto = new Producto();

try{
    $objProducto->setCodigoProducto($codigoProd);
    if($objProducto->ModificarEstado()){
        echo "exito";
    }
} catch (Exception $exc) {
    
    header("HTTP/1.1 500");
    echo $exc->getMessage();

}