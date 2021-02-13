<?php

require_once '../negocio/Proveedor.class.php';

$valorBusqueda = $_GET["term"];

if (!$valorBusqueda){
    return;
}

$objProveedor = new Proveedor();
try {
    $resultado = 
            $objProveedor->obtenerProveedor($valorBusqueda);
    
    $retorno = array();
    
    for ($i = 0; $i < count($resultado); $i++) {
        $datos = array
            (
                "label" => $resultado[$i]["razonsocial"],
                "value" => array(
                    "cod" => $resultado[$i]["codproveedor"],
                    "ruc" => $resultado[$i]["ruc"],
                    "rs"  => $resultado[$i]["razonsocial"],
                    "dir" => $resultado[$i]["direccion"],
                )
            );
        $retorno[$i] = $datos;
    }
    
    echo json_encode($retorno);
    
    
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

