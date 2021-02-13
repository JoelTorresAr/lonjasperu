<?php

require_once '../negocio/Producto.class.php';

$valorBusqueda = $_GET["term"];

if(!$valorBusqueda){
    return;
}

$objProducto = new Producto();

try {
    
    $resultado = $objProducto->obtenerProducto($valorBusqueda);
    $retorno = array();
    
    for($i = 0; $i < count($resultado); $i++){
        $datos = array(
            "label" => $resultado[$i]["nombre"],
            "value" => array(
                "codprod" => $resultado[$i]["codproducto"],
                "nomprod" => $resultado[$i]["nombre"],                
                "stock" => $resultado[$i]["stock"],                
                "unidad" => $resultado[$i]["unidad"],               
                "idunidad" => $resultado[$i]["idunidad"]              
            )
        );
        $retorno[$i] = $datos;
    }echo json_encode($retorno);
}catch (Exception $ex) {
    echo $exc->getMessage();
}