<?php

    require_once '../negocio/Categoria.class.php';
    require_once '../util/funciones/Funciones.class.php';

    $codigo_linea = $_POST["p_codigo_linea"];
    $modal =        $_POST["p_modal"];

    $objCat = new Categoria();
    try {
        $resultado = $objCat->obtenerCategorias($codigo_linea);
    } catch (Exception $exc) {
        header("HTTP/1.1 500"); //CONFIGURAR AL NAVEGADOR QUE RECONOZA EL MENSAJE COMO ERROR
        echo $exc->getMessage();
        exit();
        //Funciones::mensaje($exc->getMessage(), "e");
    }

    if ($modal == "0"){
        echo '<option value="0">Todas las categorías</option>';
    }else{
        echo '<option value="">Seleccione una categoría</option>';
    }
    for ($i = 0; $i < count($resultado); $i++) {
        echo '<option value="'.$resultado[$i]["codigo_categoria"].'">'.$resultado[$i]["descripcion"].'</option>';
    }



