<?php

    require_once '../negocio/Pedido.class.php';
    require_once '../util/funciones/Funciones.class.php';

    $Tpen = $_POST["P_Tpen"];
    $cod_ped = $_POST["P_cod_ped"];
    
    $objPedido = new Pedido();

    try {
//        $respuesta = $objPedido->AtenderPedido($cod_ped);
        
        
        if ( $objPedido->AtenderPedido($Tpen,$cod_ped)=="P"){
            echo 'pendiente';
        }
        else {
            echo 'atendido';
        }
        
        
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>

    