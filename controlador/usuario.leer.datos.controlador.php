<?php

require_once '../negocio/Usuario.class.php';

$dni = $_POST["p_dni"];

$objUsuario = new Usuario();
try {
    $resultado = $objUsuario->leerDatos($dni);
    echo json_encode($resultado);
}catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}




