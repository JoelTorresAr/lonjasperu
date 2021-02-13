<?php
require_once '../negocio/Usuario.class.php';
parse_str($_POST["p_array_datos"], $datosFrm);

$objUsuario = new Usuario();

$objUsuario->setDni($datosFrm["txtdni"]);
$objUsuario->setNombre($datosFrm["txtnombre"]);
$objUsuario->setApe_pat($datosFrm["txtapep"]);
$objUsuario->setApe_mat($datosFrm["txtapem"]);
$objUsuario->setDireccion($datosFrm["txtdir"]);
$objUsuario->setTeleono($datosFrm["txttelefono"]);
$objUsuario->setEmail($datosFrm["txtemail"]);
$objUsuario->setClave($datosFrm["txtpass"]);
$objUsuario->setCargo($datosFrm["cmb-cargo"]);
$objUsuario->setArea($datosFrm["cmb-area"]);

try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objUsuario->agregar()==true){
            echo "exito";
        }
    }else{
        if ($objUsuario->editar()==true){
            echo "exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}