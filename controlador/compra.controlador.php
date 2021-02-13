<?php

require_once '../negocio/Compra.class.php';

parse_str($_POST["p_array_datos_cabecera"], $datosCabecera);
$datosDetalle = $_POST["p_json_datos_detalle"];

$objCompra = new Compra();
//$objCompra->setCodigoTipoComprobante($datosCabecera["cbotipdoc"]);
$objCompra->setCodProveedor($datosCabecera["txtcodprov"]);
$objCompra->setNroComprobante($datosCabecera["txtnro"]);
$objCompra->setTipoComprobante($datosCabecera["tipoComprobante"]);
//$objCompra->setNumeroSerie($datosCabecera["txtnroser"]);
//$objCompra->setNumeroDocumento($datosCabecera["txtnrodoc"]);
$objCompra->setFechaCompra($datosCabecera["txtfec"]);
//$objCompra->setPorcentajeIgv($datosCabecera["txtigv"]);
//$objCompra->setSubTotal($datosCabecera["txtimportesubtotal"]);
$objCompra->setNeto($datosCabecera["txtimporteneto"]);
$objCompra->setIgv($datosCabecera["txtimporteigv"]);
$objCompra->setTotal($datosCabecera["txtimportetotal"]);
//$objCompra->setCodigoUsuario(1);
$objCompra->setDetalle( $datosDetalle );

try {
    if ($objCompra->agregar()){
        echo "exito";
    }
} catch (Exception $exc) {
    header("HTTP/1.1 500");
    echo $exc->getMessage();
}



