<?php

require_once '../negocio/TipoComprobante.php';

$objTipCom = new TipoComprobante();

try {
    $resultado = $objTipCom->cargarTipoComprobante();
} catch (Exception $exc) {
    header("HTTP/1.1 500"); //CONFIGURAR AL NAVEGADOR QUE RECONOZA EL MENSAJE COMO ERROR
    echo $exc->getMessage();
    exit();
}

for ($i = 0; $i < count($resultado); $i++) {
    echo '<option value="'.$resultado[$i]["codigo_tipo_comprobante"].'">'.$resultado[$i]["descripcion"].'</option>';
}
