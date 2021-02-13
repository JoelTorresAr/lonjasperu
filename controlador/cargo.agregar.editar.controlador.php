<?php
require_once '../negocio/Cargo.class.php';
parse_str($_POST["p_array_datos"], $datosFrm);

$objCargo = new Cargo();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objCargo->setCodigoCargo($datosFrm["txtcodigo"]);
}
$objCargo->setDescripcion($datosFrm["txtdescripcion"]);

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objCargo->agregar()==true){
            echo "exito";
        }
    }else{
        if ($objCargo->editar()==true){
            echo "exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}