<?php

$codigoUnidad = $_POST["codunidad"];

require_once '../negocio/Unidad.class.php';
$objUnidad = new Unidad();

try{
    $objUnidad->setCodigo($codigoUnidad);
    if($objUnidad->eliminar()){
        echo "exito";
    }
} catch (Exception $ex) {
    
    header("HTTP/1.1 500");
    echo $exc->getMessage();

}