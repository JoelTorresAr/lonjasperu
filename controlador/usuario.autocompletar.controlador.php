<?php

require_once '../negocio/Usuario.class.php';

$valorBusqueda = $_GET["term"];

if(!$valorBusqueda){
    return;
}

$objUsuario= new Usuario();
try {
    $resultado = 
            $objUsuario->obtenerUsuario($valorBusqueda);
    
    $retorno = array();
    
    for ($i = 0; $i < count($resultado); $i++) {
        $datos = array
            (
                "label" => $resultado[$i]["nombre"],
                "value" => array(
                    "cod" => $resultado[$i]["codigo_usuario"],
                    "nom"  => $resultado[$i]["nombre"],
                    "dni" => $resultado[$i]["dni"],
                    
                )
            );
        $retorno[$i] = $datos;
    }
    
    echo json_encode($retorno);
    
    
    
} catch (Exception $exc) {
    echo $exc->getMessage();
}

