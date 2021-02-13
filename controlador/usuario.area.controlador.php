<?php

    require_once '../negocio/Area.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    $objArea = new Area();
    try {
        $resultado = $objArea->listarArea();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
//    $modal = $_GET["modal"];
//    if ($modal == "0"){
//        echo '<option value="0">Todas las unidades</option>';
//    }else{
//        echo '<option value="">Selecione una linea</option>';
//    }
    echo '<option value="0">Seleccione un Area</option>';
    for ($i=0; $i<count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["codigo_area"].'">'. strtoupper($resultado[$i]["nombre"]).'</option>';
    }


    
    
    

