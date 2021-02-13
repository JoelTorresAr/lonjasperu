<?php
require_once '../negocio/Proveedor.class.php';
parse_str($_POST["p_array_datos"], $datosFrm);

$objProveedor = new Proveedor();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objProveedor->setCodProveedor($datosFrm["txtcodigo"]);
}
$objProveedor->setRazonSocial($datosFrm["txtrazsocial"]);
$objProveedor->setRuc($datosFrm["txtruc"]);
$objProveedor->setDireccion($datosFrm["txtdireccion"]);

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objProveedor->agregar()==true){
            echo "exito";
        }
    }else{
        if ($objProveedor->editar()==true){
            echo "exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}