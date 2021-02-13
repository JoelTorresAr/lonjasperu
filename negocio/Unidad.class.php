<?php

require_once '../datos/conexion.php';

class Unidad extends Conexion {

    private $idunid;
    private $nombre;

    public function getCodigo() {
        return $this->idunid;
    }

    public function getDescripcion() {
        return $this->nombre;
    }

    public function setCodigo($codigo) {
        $this->idunid = $codigo;
    }

    public function setDescripcion($descripcion) {
        $this->nombre = $descripcion;
    }

    public function obtenerUnidades() {
        try {
            $sql = "select 
                        idunid, 
                        nombre
                    from
                        unidad_medida
                    order by
                        idunid
                ";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll();

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function listarUnidad(/* $cod_Area */) {
        try {
            //            
            $sql = "select idunid, nombre from unidad_medida order by 1";
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":cod_area", $this->getCodigoArea());
            $sentencia->execute();

            $registros = $sentencia->fetchAll();

            return $registros;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function agregar() {
        $this->dblink->beginTransaction();

        try {
            $sql = "select max(idunid)+1 as nuevoid from unidad_medida";
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":cod_area", $this->getCodigoArea());
            $sentencia->execute();
            $registros = $sentencia->fetch();
            $nuevo_cod = $registros['nuevoid'];
            $this->setCodigo($nuevo_cod);

            $sql = "insert into unidad_medida(idunid, nombre) values (:id , :desc);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":id", $this->getCodigo());
            $sentencia->bindParam(":desc", $this->getDescripcion());

            $sentencia->execute();



            $this->dblink->commit();
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return true;
    }

    public function editar() {
        $this->dblink->beginTransaction();

        try {

            $sql = "update unidad_medida "
                    . "set "
                    . "nombre = :p_des "
                    . "where "
                    . "idunid = :p_cc";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cc", $this->getCodigo());
            $sentencia->bindParam(":p_des", $this->getDescripcion());
            $sentencia->execute();

            $this->dblink->commit();
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }

        return true;
    }

    public function leerDatos($codigo) {
        try {
            $sql = "
                select * from unidad_medida where idunid = :p_cc
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cc", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

    public function eliminar() {
        try {
            $sql = "delete from unidad_medida where idunid = :p_cc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cc", $this->getCodigo());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }

        return true;
    }

}
