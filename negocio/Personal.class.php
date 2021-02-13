<?php

require_once '../datos/conexion.php';

class Personal extends Conexion {
    private $codPersonal;
    private $dni;
    private $apellido_paterno;
    private $apellido_materno;
    private $nombres;
    
    
    public function getCodPersonal() {
        return $this->codPersonal;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getApellido_paterno() {
        return $this->apellido_paterno;
    }

    public function getApellido_materno() {
        return $this->apellido_materno;
    }

    public function getNombres() {
        return $this->nombres;
    }



    public function setCodPersonal($codPersonal) {
        $this->codPersonal = $codPersonal;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setApellido_paterno($apellido_paterno) {
        $this->apellido_paterno = $apellido_paterno;
    }

    public function setApellido_materno($apellido_materno) {
        $this->apellido_materno = $apellido_materno;
    }

    public function setNombres($nombres) {
        $this->nombres = $nombres;
    }

    public function listarPersonal(/*$cod_Area*/) {
        try {
//            if($cod_Area== null || $cod_Area==''){
//                $cod_Area=0;
//                $this->setCodigoArea($cod_Area);
//            }else{
//                $this->setCodigoArea($cod_Area);
//            }
            $sql = "select dni,apellido_paterno,apellido_materno,nombres,codpersonal,
                    apellido_paterno || ' ' || apellido_materno ||' ' || nombres as trabajador
                    from personal order by apellido_paterno,apellido_materno,nombres";
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
           
                
                $sql = "insert into area(nombre,descripcion) values (:nom_area, :desc);";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":nom_area", $this->getNombreArea());
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
