<?php

require_once '../negocio/Area.class.php';

$valorBusqueda = $_GET["term"];

if(!valorBusqueda){
    return;
}

$objArea = new Area();

try {
    
    $resultado = $objArea->buscarArea($valorBusqueda);
    $retorno = array();
    
    for($i = 0; $i < count($resultado); $i++){
        $datos = array(
            "label" => $resultado[$i]["nombrearea"],
            "value" => array(
                "codarea" => $resultado[$i]["codarea"],
                "nombrearea" => $resultado[$i]["nombrearea"],                
            )
        );
        $retorno[$i] = $datos;
    }echo json_encode($retorno);
}catch (Exception $ex) {
    echo $exc->getMessage();
}