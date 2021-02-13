<?php

    require_once '../negocio/Marca.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    $modal = $_GET["modal"];
    
    $objMarca = new Marca();
    
    try {
        $resultado = $objMarca->obtenerMarcas();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
    if ($modal == "0"){
        echo '<option value="0">Todas las marcas</option>';
    }else{
        echo '<option value="">Seleccione una marca</option>';
    }
    

    for ($i=0; $i<count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["codigo_marca"].'">'.$resultado[$i]["descripcion"].'</option>';
    }






    