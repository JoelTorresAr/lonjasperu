<?php

$codigoArea = $_POST["codarea"];

require_once '../negocio/Area.class.php';
$objArea = new Area();

try{
    $objArea->setCodigoArea($codigoArea);
    if($objArea->eliminar()){
        echo "exito";
    }
} catch (Exception $ex) {
    
    header("HTTP/1.1 500");
    echo $exc->getMessage();

}