<?php

require_once '../negocio/Compra.class.php';

$nroCompra = $_POST["p_nro_compra"];
$objCompra = new Compra();

try {
    $objCompra->setNroCompra($nroCompra);
    if ($objCompra->anular()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}
