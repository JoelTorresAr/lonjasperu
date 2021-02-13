<?php

require_once '../negocio/Articulo.class.php';

$valorBusqueda = $_GET["term"];

if (!$valorBusqueda){
    return;
}

$objArea = new Area();
try {
    $resultado = 
            $objArea->buscarArticulo($valorBusqueda);
    
    $retorno = array();
    
    for ($i = 0; $i < count($resultado); $i++) {
        $datos = array
            (
                "label" => $resultado[$i]["nombre"],
                "value" => array(
                    "codigo"  => $resultado[$i]["codigo_articulo"],
                    "nombre"  => $resultado[$i]["nombre"],
                    "preciov" => $resultado[$i]["precio_venta"],
                )
            );
        $retorno[$i] = $datos;
    }
    
    echo json_encode($retorno);
    
    
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

