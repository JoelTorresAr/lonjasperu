<?php
require_once '../negocio/Producto.class.php';
parse_str($_POST["p_array_datos"], $datosFrm);

$objProducto = new Producto();
if ($datosFrm["txttipooperacion"]=="editar"){
    $objProducto->setCodigoProducto($datosFrm["txtcodigo"]);
}
/*
$objProducto->setNombreProd($datosFrm["txtnombre"]);
$objProducto->setStockMin($datosFrm["txtstockmin"]);
$objProducto->setStock($datosFrm["txtstock"]);
$objProducto->setUnidad($datosFrm["cmb-descripcion"]);
$objProducto->setPrecio($datosFrm["txtcosto"]);
$objProducto->setPrecioVenta($datosFrm["txtventa"]);
*/
$objProducto->setNombreProd($datosFrm["txtnombre"]);
$objProducto->setStockMin(0);
$objProducto->setStock(0);
$objProducto->setUnidad($datosFrm["cmb-descripcion"]);
$objProducto->setPrecio(0);
$objProducto->setPrecioVenta(0);
try {
    if ($datosFrm["txttipooperacion"]=="agregar"){
        if ($objProducto->agregar()==true){
            echo "exito";
        }
    }else{
        if ($objProducto->editar()==true){
            echo "exito";
        }
    }
    
} catch (Exception $ex) {
    header("HTTP/1.1 500");
    echo $ex->getMessage();
}