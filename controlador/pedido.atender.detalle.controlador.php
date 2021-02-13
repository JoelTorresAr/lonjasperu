<?php

    require_once '../negocio/Pedido.class.php';
    require_once '../util/funciones/Funciones.class.php';

    $detalle = $_POST["P_detalle"];
    
    $objPedido = new Pedido();

    try {
//        $respuesta = $objPedido->AtenderPedido($cod_ped);
        
        $tpen = $objPedido->actualizar_pedido($detalle);
        echo $tpen;
    
        
        
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>

    