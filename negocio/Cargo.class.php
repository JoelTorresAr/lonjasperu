<?php

require_once '../datos/conexion.php';

class Cargo extends Conexion {
    private $codigo_cargo;
    private $descripcion;
    
    
    public function getCodigoCargo() {
        return $this->codigo_cargo;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function setCodigoCargo($codigoCargo) {
        $this->codigo_cargo = $codigoCargo;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function listarCargo(/*$cod_Area*/) {
        try {
//            if($cod_Area== null || $cod_Area==''){
//                $cod_Area=0;
//                $this->setCodigoArea($cod_Area);
//            }else{
//                $this->setCodigoArea($cod_Area);
//            }
            $sql = "select codigo_cargo, descripcion from cargo order by 1";
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
           
                
                $sql = "insert into cargo(descripcion) values (:desc);";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":desc", $this->getDescripcion());
                
                $sentencia->execute();
                
               
                
                $this->dblink->commit();
                
            }
            
        catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;
        
    }
    
    public function editar() {
        $this->dblink->beginTransaction();
        
        try {
            
            $sql = "update cargo "
                    . "set "
                    . "descripcion = :p_des "
                    . "where "
                    . "codigo_cargo = :p_cc";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cc", $this->getCodigoCargo());
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
                select * from cargo where codigo_cargo=:p_cc
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
//    public function leerDatos($codigo) {
//        try {
//            $sql = "
//                select
//                        a.codarea,
//                        a.nombrearea,
//                        a.descripcion,
//                        a.codigo_categoria,
//                        a.codigo_marca,
//                        c.codigo_linea
//                from
//                        articulo a
//                        inner join categoria c 
//                        on ( a.codigo_categoria = c.codigo_categoria )
//                where
//                        a.codigo_articulo = :p_ca
//                ";
//            $sentencia = $this->dblink->prepare($sql);
//            $sentencia->bindParam(":p_ca", $codigo);
//            $sentencia->execute();
//            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
//            return $resultado;
//        } catch (Exception $exc) {
//            throw $exc;
//        }
//            
//    }
    
    public function eliminar() {
        try {
            $sql = "delete from cargo where codigo_cargo = :p_cc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cc", $this->getCodigoCargo());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }
        
        return true;
    }
    
    public function buscarArea($nombreArea) {
        try {
            $sql = "
                    select 
                        codarea, 
                        nombrearea, 
                        descripcion 
                    from 
                        areas 
                    where
                        upper(nombrearea) like :p_na
                ";
            $sentencia = $this->dblink->prepare($sql);
            $nombreArea = '%'.strtoupper($nombreArea).'%';
            $sentencia->bindParam(":p_na", $nombreArea);
            $sentencia->execute();
            $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }


}
