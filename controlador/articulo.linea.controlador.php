<?php

    require_once '../negocio/Linea.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    $objLinea = new Linea();
    try {
        $resultado = $objLinea->obtenerLineas();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
    $modal = $_GET["modal"];
    if ($modal == "0"){
        echo '<option value="0">Todas las lineas</option>';
    }else{
        echo '<option value="">Selecione una linea</option>';
    }

    for ($i=0; $i<count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["codigo_linea"].'">'.$resultado[$i]["descripcion"].'</option>';
    }


    
    
    

