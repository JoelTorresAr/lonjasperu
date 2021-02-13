<?php

require_once '../negocio/Pedido.class.php';

parse_str($_POST["p_array_datos_cabecera"], $datosCabecera);
$datosDetalle = $_POST["p_json_datos_detalle"];

$objPedido = new Pedido();
$dni = $datosCabecera["txtdniusuario"];
$fecha = $datosCabecera["txtfec"];
$objPedido->setCodUsuario($dni);
$objPedido->setFechaPedido($fecha);

$objPedido->setEstado('N');
$objPedido->setDetalle($datosDetalle);



try {
    if ($objPedido->agregar()){
        echo "Pedido realizado con exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}



