<?php

$codigoCargo = $_POST["codcargo"];

require_once '../negocio/Cargo.class.php';
$objCargo = new Cargo();

try{
    $objCargo->setCodigoCargo($codigoCargo);
    if($objCargo->eliminar()){
        echo "exito";
    }
} catch (Exception $ex) {
    
    header("HTTP/1.1 500");
    echo $exc->getMessage();

}