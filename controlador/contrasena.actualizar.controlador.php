<?php

session_name("sistema-comercial");
    session_start();
    $codigo = $_SESSION["cod_usuario"];

require_once '../negocio/Usuario.class.php';
parse_str($_POST["p_array_datos"], $datosFrm);

$objUsuario = new Usuario();




try {
    
    $pass = $datosFrm["txtpass-3"];
    
        $objUsuario->cambiar_clave($codigo, $pass);
            echo "exito";
      
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}