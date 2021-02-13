<?php

    require_once '../negocio/Cargo.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    $objCargo = new Cargo();
    try {
        $resultado = $objCargo->listarCargo();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
//    $modal = $_GET["modal"];
//    if ($modal == "0"){
//        echo '<option value="0">Todas las unidades</option>';
//    }else{
//        echo '<option value="">Selecione una linea</option>';
//    }
    echo '<option value="0">Selecciona un Cargo</option>';
    for ($i=0; $i<count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["codigo_cargo"].'">'.$resultado[$i]["descripcion"].'</option>';
    }


    
    
    

