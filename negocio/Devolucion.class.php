<?php

require_once '../datos/conexion.php';

class Devolucion extends Conexion {
    private $id_dev;
    
    private $idusuario;
    
    private $idarea;
    
    private $fecha;
    
    private $detalle;

    
    
    public function getIdDev() {
        return $this->id_dev;
    }

    public function getIdUsuario() {
        return $this->idusuario;
    }
    
    public function getIdArea() {
        return $this->idarea;
    }
    
    public function getFecha() {
        return $this->fecha;
    }
    
    public function getDetalle() {
        return $this->detalle;
    }
    
    
   
    public function setIdDev($id_dev) {
        $this->id_dev = $id_dev;
    }

    public function setIdUsuario($idusuario) {
        $this->idusuario = $idusuario;
    }

    public function setIdArea($idarea) {
        $this->idarea = $idarea;
    }

    public function setFecha($fecha) {
        $this->fecha = $fecha;
    }
    
    public function setDetalle($detalle) {
        $this->detalle = $detalle;
    }
    
  

    public function agregar() {
        $this->dblink->beginTransaction();
        try {
            $sql = "select numero+1 as nc from correlativo where tabla = 'devolucion'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["nc"];
                $this->setIdDev($nuevoCodigo);
                
                $sql = "insert into devolucion 
                        (
                            id_dev,
                            id_usuario,
                            id_area,
                            fecha
                        )
                        values
                        (
                            :p_nc,
                            :p_cu,
                            :p_ca,
                            :p_fc
                        )";
                
                $sentencia = $this->dblink->prepare($sql);
                
                $sentencia->bindParam(":p_nc", $this->getIdDev());
                $sentencia->bindParam(":p_cu", $this->getIdUsuario());
                $sentencia->bindParam(":p_ca", $this->getIdArea());
                $sentencia->bindParam(":p_fc", $this->getFecha());
                
                $sentencia->execute();
                
                
                $datosDetalle = json_decode( $this->getDetalle() );
                //print_r($datosDetalle);
                
                foreach ($datosDetalle as $key => $value){
                    
                    $sql = "insert into 
                        detalledevolucion 
                        values(
                        :p_id_dev,
                        :p_id_prod, 
                        :p_cant 
                        )";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_id_dev", $this->getIdDev() );
                    $sentencia->bindParam(":p_id_prod", $value->codProducto );
                    $sentencia->bindParam(":p_cant", $value->cantidad );
                    $sentencia->execute();
                    
                    /*ACTUALIZAR EL STOCK DE LOS ARTICULO QUE SE ESTA DEVOLVIENDO*/
                    $sql2 = "update producto 
                                    set stock = stock + :p_cant 
                            where   
                                    codproducto = :p_id_prod";
                    $sentencia = $this->dblink->prepare($sql2);
                    $sentencia->bindParam(":p_cant", $value->cantidad);
                    $sentencia->bindParam(":p_id_prod", $value->codProducto);
                    $sentencia->execute();
                    /*ACTUALIZAR EL STOCK DE LOS ARTICULO QUE SE ESTA DEVOLVIENDO*/
                    
                }
                
                
                $sql3 = "update correlativo set numero=numero+1 where tabla='devolucion'";
                $sentencia = $this->dblink->prepare($sql3);
                $sentencia->execute();
                
                $this->dblink->commit();
                
            }
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;
    }
    
    public function listar($fecha1, $fecha2, $tipo) {
        try {
            $sql = "select * from f_listar_devoluciones(:fecha1, :fecha2, :tipo);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":fecha1", $fecha1);
            $sentencia->bindParam(":fecha2", $fecha2);
            $sentencia->bindParam(":tipo", $tipo);
            $sentencia->execute();

            $registros = $sentencia->fetchAll();

            return $registros;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function listarDetalle($codDev) {
        try {
            $sql = "select * from f_listar_detalle_devolucion(:cod_dev);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":cod_dev", $codDev);
            $sentencia->execute();

            $registros = $sentencia->fetchAll();

            return $registros;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    public function obtenerArea($idUsuario){
        
        
        
        try {
            $sql = "select 
                    p.codigo_area as id_area,
                    a.nombre as area 
                    from 
                    personal p inner join usuario u on (p.dni = u.dni_usuario)
                    inner join area a on (p.codigo_area = a.codigo_area)
                    where 
                    codigo_usuario = :p_idUsuario";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_idUsuario", $idUsuario);
            $sentencia->execute();

            $registros = $sentencia->fetch(PDO::FETCH_ASSOC);

            return $registros;
        } catch (Exception $exc) {
            throw $exc;
        }
        
    }

    

    public function anular() {
        $this->dblink->beginTransaction();
        try {
            $sql = "select codigo_articulo, cantidad from compra_detalle where nro_compra = :p_nro_compra";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nro_compra", $this->getNroCompra());
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            for ($i = 0; $i < count($resultado); $i++) {
                $sql = "update articulo set stock = stock - :p_cantidad where codigo_articulo = :p_codigo_articulo";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_cantidad", $resultado[$i]["cantidad"]);
                $sentencia->bindParam(":p_codigo_articulo", $resultado[$i]["codigo_articulo"]);
                $sentencia->execute();
            }
            
            $sql = "update compra set estado = 'A' where nro_compra = :p_nro_compra";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_nro_compra", $this->getNroCompra());
            $sentencia->execute();
            
            $this->dblink->commit();
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;
    }
    
}
