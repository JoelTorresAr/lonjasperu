<?php

require_once '../datos/conexion.php';

class Compra extends Conexion {
    private $nroCompra;
    
    private $nroComprobante;

    private $tipoComprobante;

    private $codProveedor;
    
    private $fechaCompra;
    
    private $neto;

    private $igv;

    private $total;
    
    private $detalle;
    
    
    public function getNroCompra() {
        return $this->nroCompra;
    }

    public function getNroComprobante() {
        return $this->nroComprobante;
    }

    public function getTipoComprobante() {
        return $this->tipoComprobante;
    }

    public function getCodProveedor() {
        return $this->codProveedor;
    }
    
    public function getFechaCompra() {
        return $this->fechaCompra;
    }
    
    public function getNeto() {
        return $this->neto;
    }

    public function getIGV() {
        return $this->igv;
    }

    public function getTotal() {
        return $this->total;
    }
    
    public function getDetalle() {
        return $this->detalle;
    }
    
    public function setNroCompra($nroCompra) {
        $this->nroCompra = $nroCompra;
    }

    public function setNroComprobante($nroComprobante) {
        $this->nroComprobante = $nroComprobante;
    }

    public function setTipoComprobante($tipoComprobante) {
        $this->tipoComprobante = $tipoComprobante;
    }

    public function setCodProveedor($rucProveedor) {
        $this->codProveedor = $rucProveedor;
    }

    public function setFechaCompra($fechaCompra) {
        $this->fechaCompra = $fechaCompra;
    }

    public function setNeto($neto) {
        $this->neto = $neto;
    }
    
    public function setIGV($igv) {
        $this->igv = $igv;
    }
    
    public function setTotal($total) {
        $this->total = $total;
    }
    
    public function setDetalle($detalle) {
        $this->detalle = $detalle;
    }

    public function agregar() {
        $this->dblink->beginTransaction();
        try {

            session_start();
            $sql = "select numero+1 as nc from correlativo where tabla = 'compra'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["nc"];
                $this->setNroCompra($nuevoCodigo);
               
                $sql = "insert into compra 
                        (
                            codcompra,
                            codproveedor,
                            neto,
                            igv_compra,
                            total,
                            fechacompra,
                            nrocomprobante,
                            tipocomprobante
                        )
                        values
                        (
                            :p_nc,
                            :p_cp,
                            :p_ne,
                            :p_igv,
                            :p_to,
                            :p_fc,
                            :p_cc,
                            :p_tc
                        )";
                
                $sentencia = $this->dblink->prepare($sql);
                
                $sentencia->bindParam(":p_nc", $this->getNroCompra());
                $sentencia->bindParam(":p_cp", $this->getCodProveedor());
                $sentencia->bindParam(":p_ne", $this->getNeto());
                $sentencia->bindParam(":p_igv", $this->getIGV());
                $sentencia->bindParam(":p_to", $this->getTotal());
                $sentencia->bindParam(":p_fc", $this->getFechaCompra());
                $sentencia->bindParam(":p_cc", $this->getNroComprobante());
                $sentencia->bindParam(":p_tc", $this->getTipoComprobante());
                $numerocomprobante_ing = $this->getNroComprobante();
                $sentencia->execute();
                
                $sql = "select numero+1 as nc from correlativo where tabla = 'ingreso'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();

                if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["nc"];
                
                $sql = "insert into ingreso 
                        (
                            codigo_ing,
                            numero_ing,
                            codproveedor,
                            fecha,
                            estado,
                            fechareg,
                            usuarioreg,
                            codigo_mi,
                            codcompra
                        )
                        values
                        (
                            :p_ni,
                            :p_nc,
                            :p_cp,
                            :p_fec,
                            1,
                            :p_fec,
                            :p_usu,
                            1,
                            :p_cc
                        )";
                
                $sentencia = $this->dblink->prepare($sql);                
                $sentencia->bindParam(":p_ni", $nuevoCodigo);
                $sentencia->bindParam(":p_nc", $numerocomprobante_ing);                
                $sentencia->bindParam(":p_cp", $this->getCodProveedor());
                $sentencia->bindParam(":p_fec", date('d/m/Y H:i:s'));
                $sentencia->bindParam(":p_usu", $_SESSION["cod_usuario"]);
                $sentencia->bindParam(":p_cc", $this->getNroCompra());
                
                $sentencia->execute();
            
                $datosDetalle = json_decode( $this->getDetalle() );
                //print_r($datosDetalle);
                
                foreach ($datosDetalle as $key => $value){
                    
                    $sql = "insert into 
                        detallecompra 
                        values(
                        :p_ca,
                        :p_nc, 
                        :p_can,
                        :p_pre,
                        :p_item 
                        )";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_nc", $this->getNroCompra() );
                    $sentencia->bindParam(":p_ca", $value->codigoArticulo );
                    $sentencia->bindParam(":p_item", $value->item );
                    $sentencia->bindParam(":p_can", $value->cantidad );
                    $sentencia->bindParam(":p_pre", $value->precio );
                    
                    $sentencia->execute();
                    
                    /*ACTUALIZAR EL STOCK DE LOS ARTICULO QUE SE ESTA COMPRANDO*/
                    $sql2 = "update producto 
                                    set stock = stock + :p_can 
                            where   
                                    codproducto = :p_ca";
                    $sentencia = $this->dblink->prepare($sql2);
                    $sentencia->bindParam(":p_can", $value->cantidad);
                    $sentencia->bindParam(":p_ca", $value->codigoArticulo);
                    $sentencia->execute();
                    /*ACTUALIZAR EL STOCK DE LOS ARTICULO QUE SE ESTA COMPRANDO*/

                    $sql = "insert into 
                        detalleingreso(codigo_ing,codproducto,cantidad,idunidad,precio)
                        values(
                        :p_cs,
                        :p_cp, 
                        :p_can,
                        :p_uni,
                        :p_pre
                        )";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_cs", $nuevoCodigo );
                    $sentencia->bindParam(":p_cp", $value->codigoArticulo );
                    $sentencia->bindParam(":p_can", $value->cantidad );
                    $sentencia->bindParam(":p_uni", $value->idunidad );
                    $sentencia->bindParam(":p_pre", $value->precio );
                    
                    $sentencia->execute();
                    
                }
                }
                
                $sql3 = "update correlativo set numero=numero+1 where tabla='ingreso'";
                $sentencia = $this->dblink->prepare($sql3);
                $sentencia->execute();

                $sql3 = "update correlativo set numero=numero+1 where tabla='compra'";
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
            $sql = "select * from f_listar_compras(:fecha1, :fecha2, :tipo);";
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
    
    public function listarDetalle($codPedido) {
        try {
            $sql = "select * from f_listar_detalle_compra(:cod_pedido);";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":cod_pedido", $codPedido);
            $sentencia->execute();

            $registros = $sentencia->fetchAll();

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
