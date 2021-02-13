<?php
$codigoArticulo = $_POST["p_codigo_articulo"];

require_once '../negocio/Articulo.class.php';
$objArea = new Area();

try {
    $objArea->setCodigoArea($codigoArticulo);
    if ($objArea->eliminar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}


