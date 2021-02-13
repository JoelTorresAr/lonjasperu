<?php

    require_once '../negocio/Devolucion.class.php';
   
    $IdUsuario = $_POST["p_idUsuario"];
    
$objDevolucion = new Devolucion();
    
try {
    $resultado = $objDevolucion->obtenerArea($IdUsuario);
    
    echo json_encode($resultado);
    
    
    
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
