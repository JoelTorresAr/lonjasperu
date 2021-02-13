<?php

    require_once '../negocio/Unidad.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    $objUnidad = new Unidad();
    try {
        $resultado = $objUnidad->obtenerUnidades();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
//    $modal = $_GET["modal"];
//    if ($modal == "0"){
//        echo '<option value="0">Todas las unidades</option>';
//    }else{
//        echo '<option value="">Selecione una linea</option>';
//    }
    echo '<option value="0">Todas las unidades</option>';
    for ($i=0; $i<count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["idunid"].'">'.$resultado[$i]["nombre"].'</option>';
    }


    
    
    

