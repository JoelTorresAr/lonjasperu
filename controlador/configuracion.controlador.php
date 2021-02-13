<?php

require_once '../negocio/Configuracion.class.php';

$codigoConfiguracion = $_POST["p_codigo"];

$objConf = new Configuracion();
$resultado = $objConf->obtenerValor($codigoConfiguracion);
echo $resultado["valor"];

