<?php
session_name("sistema-comercial");
    session_start();
require_once '../negocio/Usuario.class.php';
require_once '../util/funciones/Funciones.class.php';

parse_str($_POST["p_array_datos"], $datosFrm);
$codigo = $_SESSION["cod_usuario"];


$objUsuario = new Usuario();

   try { 

    
        $pass = $datosFrm["txtpass-1"];

        $registro = $objUsuario->obtenerContrasena($codigo);
        
        $passoriginal = $registro["clave"];

        if(md5($pass) == $passoriginal){
            echo "exito";
        }


    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}