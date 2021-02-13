<?php
require_once '../negocio/Unidad.class.php';
parse_str($_POST["p_array_datos"], $datosFrm);

$objUnidad = new Unidad();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objUnidad->setCodigo($datosFrm["txtcodigo"]);
}
$objUnidad->setDescripcion($datosFrm["txtdescripcion"]);

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objUnidad->agregar()==true){
            echo "exito";
        }
    }else{
        if ($objUnidad->editar()==true){
            echo "exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}