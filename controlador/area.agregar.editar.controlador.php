<?php
require_once '../negocio/Area.class.php';
parse_str($_POST["p_array_datos"], $datosFrm);

$objArea = new Area();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objArea->setCodigoArea($datosFrm["txtcodigo"]);
}
$objArea->setNombreArea($datosFrm["txtnombre"]);
$objArea->setDescripcion($datosFrm["txtdescripcion"]);
$objArea->setEncargado($datosFrm["cmb-encargado"]);

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objArea->agregar()==true){
            echo "exito";
        }
    }else{
        if ($objArea->editar()==true){
            echo "exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}