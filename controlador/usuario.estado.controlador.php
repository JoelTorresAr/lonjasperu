<?php

$dni = $_POST["P_dni"];

require_once '../negocio/Usuario.class.php';
$objUsuario = new Usuario();

try{
    $objUsuario->setDni($dni);
 
    if($objUsuario->ModificarEstado()){
        echo "exito";
    }
} catch (Exception $exc) {
    
    header("HTTP/1.1 500");
    echo $exc->getMessage();

}