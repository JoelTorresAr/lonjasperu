<?php

require_once '../negocio/Devolucion.class.php';

parse_str($_POST["p_array_datos_cabecera"], $datosCabecera);
$datosDetalle = $_POST["p_json_datos_detalle"];

$objDevolucion = new Devolucion();

$objDevolucion->setIdUsuario($datosCabecera["txtdniusuario"]);
$objDevolucion->setIdArea($datosCabecera["txtidarea"]);
$objDevolucion->setFecha($datosCabecera["txtfec"]);

//$objDevolucion->setEstado('N');
$objDevolucion->setDetalle($datosDetalle);



try {
    if ($objDevolucion->agregar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}



