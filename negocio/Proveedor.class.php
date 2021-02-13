<?php

require_once '../datos/conexion.php';

class Proveedor extends Conexion {
    
    private $codproveedor;
    private $razonsocial;
    private $razoncomercial;
    private $ruc;
    private $direccion;
    
    
    public function getCodProveedor(){
        return $this->codproveedor;
    }
    public function getRazonSocial(){
        return $this->razonsocial;
    }
    public function getRazonComercial(){
        return $this->razoncomercial;
    }
    public function getRuc(){
        return $this->ruc;
    }
    public function getDireccion(){
        return $this->direccion;
    }
    
    public function setCodProveedor($codproveedor){
        $this->codproveedor = $codproveedor;
    }
    public function setRazonSocial($razonsocial){
        $this->razonsocial = $razonsocial;
    }
    public function setRazoncomercial($razoncomercial){
        $this->razoncomercial = $razoncomercial;
    }
    public function setRuc($ruc){
        $this->ruc = $ruc;
    }
    public function setDireccion($direccion){
        $this->direccion = $direccion;
    }

    
    public function listarProveedor(/*$cod_Area*/) {
        try {
//            if($cod_Area== null || $cod_Area==''){
//                $cod_Area=0;
//                $this->setCodigoArea($cod_Area);
//            }else{
//                $this->setCodigoArea($cod_Area);
//            }
            $sql = "select codproveedor, razonsocial, ruc, direccion from proveedor order by 1";
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
           
                
                $sql = "insert into proveedor(razonsocial, ruc, direccion) values (:raz_soc, :ruc, :direccion)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":raz_soc", $this->getRazonSocial());
                $sentencia->bindParam(":ruc", $this->getRuc());
                $sentencia->bindParam(":direccion", $this->getDireccion());
                
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
            
            $sql = "update proveedor "
                    . "set "
                    . "razonsocial = :raz_soc, "
                    . "ruc = :ruc,"
                    . "direccion = :direccion "
                    . "where "
                    . "codproveedor = :cod_proveedor";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":raz_soc", $this->getRazonSocial());
            $sentencia->bindParam(":ruc", $this->getRuc());
            $sentencia->bindParam(":direccion", $this->getDireccion());
            $sentencia->bindParam(":cod_proveedor", $this->getCodProveedor());
            $sentencia->execute();

            $this->dblink->commit();
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;
        
    }

    
    public function eliminar() {
        try {
            $sql = "delete from proveedor where codproveedor = :p_cp";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cp", $this->getCodProveedor());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }
        
        return true;
    }


    public function obtenerProveedor($razonSocial) {
        try {
            $sql = "select * from proveedor where upper(razonsocial) like :p_rs";
            $sentencia = $this->dblink->prepare($sql);
            $razonSocial = '%'.strtoupper($razonSocial).'%';
            $sentencia->bindParam(":p_rs", $razonSocial);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
            
    }
    
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                select * from proveedor where codproveedor = :p_cp
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cp", $codigo);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
            
    }
    
}
