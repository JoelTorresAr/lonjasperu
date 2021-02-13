<?php

require_once '../datos/conexion.php';

class Area extends Conexion {
    private $codArea;
    private $nombreArea;
    private $descripcion;
    private $encargado;
    
    
    public function getCodigoArea() {
        return $this->codArea;
    }

    public function getNombreArea() {
        return $this->nombreArea;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getEncargado() {
        return $this->encargado;
    }


    public function setCodigoArea($codigoArea) {
        $this->codArea = $codigoArea;
    }

    public function setNombreArea($nombreArea) {
        $this->nombreArea = $nombreArea;
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
    }

    public function setEncargado($encargado) {
        $this->encargado = $encargado;
    }

    public function listarArea(/*$cod_Area*/) {
        try {
//            if($cod_Area== null || $cod_Area==''){
//                $cod_Area=0;
//                $this->setCodigoArea($cod_Area);
//            }else{
//                $this->setCodigoArea($cod_Area);
//            }
            $sql = "select a.codigo_area, nombre, descripcion,encargado_per
                    ,per.apellido_paterno || ' '||per.apellido_materno|| ' '||per.nombres as encargado
                    from area a
                    inner join personal per on per.codpersonal=a.encargado_per 
                    order by 1";
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
           
                
                $sql = "insert into area(nombre,descripcion,encargado_per) values (:nom_area, :desc,:enc);";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":nom_area", $this->getNombreArea());
                $sentencia->bindParam(":desc", $this->getDescripcion());
                $sentencia->bindParam(":enc", $this->getEncargado());
                
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
            
            $sql = "update area "
                    . "set "
                    . "nombre = :p_nom, "
                    . "descripcion = :p_des "
                    . "where "
                    . "codigo_area = :p_ca";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_ca", $this->getCodigoArea());
            $sentencia->bindParam(":p_nom", $this->getNombreArea());
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
                select * from area where codigo_area=:p_ca
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_ca", $codigo);
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
            $sql = "delete from area where codigo_area = :p_ca";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_ca", $this->getCodigoArea());
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
