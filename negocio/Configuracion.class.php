<?php

require_once '../datos/conexion.php';

class Configuracion extends Conexion {
    
    public function obtenerValor($codigo) {
        $sql = "select valor from configuracion where codigo = :p_codigo";
        $sentencia = $this->dblink->prepare($sql);
        $sentencia->bindParam(":p_codigo", $codigo);
        $sentencia->execute();
        $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }
}
