<?php

$codigoProv = $_POST["codProv"];

require_once '../negocio/Proveedor.class.php';
$objProveedor = new Proveedor();

try{
    $objProveedor->setCodProveedor($codigoProv);
    if($objProveedor->eliminar()){
        echo "exito";
    }
} catch (Exception $ex) {
    
    header("HTTP/1.1 500");
    echo $exc->getMessage();

}