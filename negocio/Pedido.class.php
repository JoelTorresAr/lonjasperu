<?php
//error_reporting (0);
require_once '../datos/conexion.php';

class Pedido extends Conexion {
    private $codPedido;
    private $codUsuario;
    private $fechaPedido;
    private $detalle;
    private $estado;
    
    
        
    public function getCodPedido() {
        return $this->codPedido;
    }
    public function getCodUsuario() {
        return $this->codUsuario;
    }
    public function getFechaPedido() {
        return $this->fechaPedido;
    }
    public function getDetalle() {
        return $this->detalle;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function setCodPedido($P_codPedido) {
        $this->codPedido = $P_codPedido;
    }
    public function setCodUsuario($P_codUsuario) {
        $this->codUsuario = $P_codUsuario;
    }
    public function setFechaPedido($P_FechaPedido) {
        $this->fechaPedido = $P_FechaPedido;
    }
    public function setDetalle($P_detalle) {
        $this->detalle = $P_detalle;
    }
    public function setEstado($P_estado) {
        $this->estado = $P_estado;
    }

    
    
    public function agregar() {
        $this->dblink->beginTransaction();
        try {
            $sql = "select numero+1 as nc from correlativo where tabla = 'pedido'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["nc"];
                $this->setCodPedido($nuevoCodigo);
                
                $sql = "insert into pedido 
                        (
                            codpedido,
                            codigo_usuario,
                            fechapedido,
                            descripcion,
                            estado
                        )
                        values
                        (
                            :p_cp,
                            :p_cu,
                            :p_fech,
                            '',
                            :p_es
                        )";
                
                $sentencia = $this->dblink->prepare($sql);


                $var1=$this->getCodPedido();
                $var2=$this->getCodUsuario();
                $var3=$this->getFechaPedido();
                $var4=$this->getEstado();

                $sentencia->bindParam(":p_cp",$var1 );
                $sentencia->bindParam(":p_cu",$var2);
                $sentencia->bindParam(":p_fech",$var3);                
                $sentencia->bindParam(":p_es", $var4);
                $sentencia->execute();
                
                
                $datosDetalle = json_decode( $this->getDetalle() );
                //print_r($datosDetalle);
                
                foreach ($datosDetalle as $key => $value) {
                    $sql = "insert into 
                        detallepedido(codpedido,codproducto,cantidad,pendiente,atendido,unidadpedido)
                        values(
                        :p_cp, 
                        :p_pro, 
                        :p_can,
                        :p_pend,
                        0,
                        :p_iduni
                        )";
                    $sentencia = $this->dblink->prepare($sql);
                    $sentencia->bindParam(":p_cp", $var1 );
                    $sentencia->bindParam(":p_pro", $value->codProducto);
                    $sentencia->bindParam(":p_can", $value->cantidad );
                    $sentencia->bindParam(":p_pend", $value->cantidad );
                    $sentencia->bindParam(":p_pend", $value->cantidad );
                    $sentencia->bindParam(":p_iduni", $value->idunidad );
                    
                    
                    $sentencia->execute();
                   
                }
                
                
                $sql = "update correlativo set numero=numero+1 where tabla='pedido'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                
                $this->dblink->commit();
                
            } 
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;
    }
    
    
    public function actualizar_pedido($Detalle){
        $this->dblink->beginTransaction();
        try {
                $datosDetalle = json_decode($Detalle,true);

                $sql = "select numero+1 as nc from correlativo where tabla = 'salida'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();
                $resultado = $sentencia->fetch();
                
                if ($sentencia->rowCount()){
                    $nuevoCodigo = $resultado["nc"];
                    //$this->setCodPedido($nuevoCodigo);

                    $sql = "insert into salida 
                            (
                                numero_sal,
                                codigo_sal, 
                                codigo_area, 
                                usuario_area, 
                                fecha, 
                                estado, 
                                fechareg, 
                                usuarioreg, 
                                codigo_ms,
                                codpedido                                
                            )
                            values
                            (
                                :p_ns,
                                :p_ns,
                                :p_ca,
                                :p_cu,
                                :p_fech,
                                1,
                                :p_fech,
                                :p_usu,
                                1,
                                :p_ped
                            )";
                    
                    $est ="1";
                    $ms="1";
                    $sentencia = $this->dblink->prepare($sql);
                    
                    $sentencia->bindParam(":p_ns", $nuevoCodigo);
                    $sentencia->bindParam(":p_ca", $datosDetalle[0]['codArea']);
                    $sentencia->bindParam(":p_cu", $datosDetalle[0]['codUsuario']);
                    $sentencia->bindParam(":p_fech",date('d/m/Y H:i:s'));       
                    $sentencia->bindParam(":p_usu",$_SESSION["cod_usuario"]);      
                    $sentencia->bindParam(":p_ped", $datosDetalle[1]['codPedido']);
                                       
                    // $sentencia->bindParam(":p_es", $est);           
                    // $sentencia->bindParam(":p_ms", $ms);
                    $sentencia->execute();
                    
                }


// var_dump( $datosDetalle);

                
                for($i = 1; $i < count($datosDetalle); ++$i) {
                //foreach ($datosDetalle as $key => $value) {
                    
                    $pen = $datosDetalle[$i]['pendiente'];
                    $can = $datosDetalle[$i]['cantidad'];
                    $stock = $datosDetalle[$i]['stock'];
                    $codpedido = $datosDetalle[$i]['codPedido'];
                    $codprod =  $datosDetalle[$i]['codProducto'];
                    $uni =  $datosDetalle[$i]['uni'];
                    $precio =  $datosDetalle[$i]['precio'];
                    
                    if($pen>0){
                        //if($pen<=$can){
                            if($can<=$stock){
                                $Nstock = $stock - $can;
                                $Npen = $pen-$can;
                              
                                    $sql = "update producto set stock = :P_Nstock where codproducto = :p_codprod";
                                    $sentencia = $this->dblink->prepare($sql);
                                    $sentencia->bindParam(":P_Nstock", $Nstock);
                                    $sentencia->bindParam(":p_codprod", $codprod);
                                    $sentencia->execute();
                                    
                                    $sql = "update detallepedido set pendiente = :P_Npen,atendido=atendido + :p_atendido where codpedido = :p_codpedido and codproducto = :p_codprod";
                                    $sentencia = $this->dblink->prepare($sql);
                                    $sentencia->bindParam(":P_Npen", $Npen);
                                    $sentencia->bindParam(":p_codpedido", $codpedido);
                                    $sentencia->bindParam(":p_codprod", $codprod);
                                    $sentencia->bindParam(":p_atendido", $can);
                                    $sentencia->execute();
                                    
                                   
                                     $sql = "insert into 
                                        detallesalida(codigo_sal,codproducto,cantidad,idunidad,precio)
                                        values(
                                        :p_cs, 
                                        :p_pro, 
                                        :p_can,
                                        :p_idu,
                                        :p_pre
                                        )";
                                    $sentencia = $this->dblink->prepare($sql);
                                    $sentencia->bindParam(":p_cs",$nuevoCodigo);
                                    $sentencia->bindParam(":p_pro", $codprod);
                                    $sentencia->bindParam(":p_can", $can);
                                    $sentencia->bindParam(":p_idu", $uni );
                                    $sentencia->bindParam(":p_pre", $precio );
                                    
                                    $sentencia->execute();

                                    
                                    
                                
                            }else{
                                echo "alert('Stock insuficiente')";
                            }
                        //}
                    }
                    
                    
                }
                
                $sql = "update correlativo set numero=numero+1 where tabla='salida'";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->execute();


                 $this->dblink->commit();

                 $sql = "select sum(pendiente)as tpen from detallepedido where codpedido = :p_codpedido";
                                    $sentencia = $this->dblink->prepare($sql);
                                    $sentencia->bindParam(":p_codpedido", $codpedido);
                                    $sentencia->execute();
                                    $resultado = $sentencia->fetch();
            
                                    if ($sentencia->rowCount()){
                                        $tpen = $resultado["tpen"];
                                        return $tpen;
                                    }
        } catch (Exception $ex) {
            $this->dblink->rollBack();
            throw $ex;
        }
    }
    

     // public function DevolverPendientes($cod_ped)
     // {
     //       $sql = "select sum(pendiente) as cantidad from detallepedido where codpedido = :p_codpedido";
     //       $sentencia = $this->dblink->prepare($sql);
     //       $sentencia->bindParam(":p_codpedido", $cod_ped);
     //       $sentencia->execute();
     //       $resultado = $sentencia->fetch();
     //       if ($sentencia->rowCount())
     //          {  
     //             $PendienteCant = $resultado["cantidad"]; 
     //             return $PendienteCant;      
     //          }   
     //          return 9;                 
     // }
    
        public function AtenderPedido($Tpen,$cod_ped)
        {
          //  $objPedido = new Pedido();
          //  $Cant= $objPedido->DevolverPendientes($cod_ped); 
          // // $Cant=4;
           //----------------------------------------------------------------------------
             try
                {                   
               //   $this->dblink->beginTransaction();
                   if( 1==1)
                     {
                       // $sql = "update pedido set estado = '".$Cant."' where codpedido = :p_codped";                        
                       // $sentencia = $this->dblink->prepare($sql);
                       // $sentencia->bindParam(":p_codped", $cod_ped);
                       // $sentencia->execute();
                       return "P";
                    }
                  else
                      {
                         // $sql = "update pedido set estado = 'A' where codpedido = :p_codped";
                         // $sentencia = $this->dblink->prepare($sql);
                         // $sentencia->bindParam(":p_codped", $cod_ped);
                         // $sentencia->execute();
                         return "A";
                      }
               //   $this->dblink->commit();
               }
               catch (Exception $exc) 
                     {
                  //        $this->dblink->rollBack();
                          throw $ex;
                     }




            
        // if($Tpen>0){

 //          if($PendienteCant>0)
 //           {
 //                try {
 //                $sql = "update pedido set estado = 'P' where codpedido = :p_codped";
 //                $sentencia = $this->dblink->prepare($sql);
 //                $sentencia->bindParam(":p_codped", $cod_ped);
 //                $sentencia->execute();
 //                return "P";

 //                } catch (Exception $exc) {
 //                    throw $exc;
 //                }
 //            }
 //            else
 //            {

 // try {
 //                $sql = "update pedido set estado = 'A' where codpedido = :p_codped";
 //                $sentencia = $this->dblink->prepare($sql);
 //                $sentencia->bindParam(":p_codped", $cod_ped);
 //                $sentencia->execute();
 //                return "A";

 //                } catch (Exception $exc) {
 //                    throw $exc;
 //                }



 //            }
        //     }
            
        // elseif ($Tpen==0) {
        //         try {
        //         $sql = "update pedido set estado = 'A' where codpedido = :p_codped";
        //         $sentencia = $this->dblink->prepare($sql);
        //         $sentencia->bindParam(":p_codped", $cod_ped);
        //         $sentencia->execute();
        //         return "A";

        //         } catch (Exception $exc) {
        //             throw $exc;
        //         }
        //     }
        
      }
    
    

        public function listar($fecha1, $fecha2, $tipo) {
        try {
            $sql = "select * from f_listar_pedidos(:fecha1,:fecha2,:tipo);";
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
            $sql = "select * from f_listar_detalle(:cod_pedido);";
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