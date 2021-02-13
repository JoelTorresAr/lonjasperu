<?php

require_once '../datos/conexion.php';

class Producto extends Conexion {
    private $codProd;
    private $nombre;
    private $stock_min;
    
    private $stock;
    private $unidad;
    private $idunidad;
    private $estado;
    private $precio;
    private $precio_venta;
    
    
    
    
    
    public function getCodigoProducto() {
        return $this->codProd;
    }

    public function getNombreProd() {
        return $this->nombre;
    }

    public function getStockMin() {
        return $this->stock_min;
    }
    
    public function getStock() {
        return $this->stock;
    }
    
    public function getUnidad() {
        return $this->unidad;
    }

    public function getIdUnidad() {
        return $this->idunidad;
    }
    public function getEstado() {
        return $this->estado;
    }

    public function getPrecio() {
        return $this->precio;
    }

    public function getPrecioVenta() {
        return $this->precio_venta;
    }

    public function setCodigoProducto($codigoProd) {
        $this->codProd = $codigoProd;
    }

    public function setNombreProd($nombreProd) {
        $this->nombre = $nombreProd;
    }

    public function setStockMin($stock_min) {
        $this->stock_min = $stock_min;
    }
    
    public function setStock($stock) {
        $this->stock = $stock;
    }
    
    public function setUnidad($unidad) {
        $this->unidad = $unidad;
    }
    public function setIdUnidad($Idunidad) {
        $this->idunidad = $Idunidad;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function setPrecio($precio) {
        $this->precio = $precio;
    }
    public function setPrecioVenta($precio_venta) {
        $this->precio_venta = $precio_venta;
    }

    public function listarProducto(/*$cod_Area*/) {
        try {
//            if($cod_Area== null || $cod_Area==''){
//                $cod_Area=0;
//                $this->setCodigoArea($cod_Area);
//            }else{
//                $this->setCodigoArea($cod_Area);
//            }
            $sql = "select p.codproducto, p.nombre, p.stock_min, p.stock, um.nombre as unidad, p.estado,p.precio,p.precio_venta from producto p inner join unidad_medida um on p.idunid = um.idunid order by 6, 1";
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
           
                
                $sql = "insert into producto(nombre,stock_min,idunid,stock,estado,precio,precio_venta) values (:nom_prod, :stock_min, :unid, :stock,'A',:pre,:prev)";
                $strproducto = $this->getNombreProd();
                $strstockmin = $this->getStockMin();
                $strstock = $this->getStock();
                $strunidad = $this->getUnidad();
                $strprecio = $this->getPrecio();
                $strprecioventa = $this->getPrecioVenta();
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":nom_prod", $strproducto);
                $sentencia->bindParam(":stock_min", $strstockmin);
                $sentencia->bindParam(":stock", $strstock);
                $sentencia->bindParam(":unid", $strunidad);
                $sentencia->bindParam(":pre", $strprecio);
                $sentencia->bindParam(":prev", $strprecioventa);
                
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
            
            $sql = "update producto "
                    . "set "
                    . "nombre = :nom_prod, "
                    . "stock_min = :stock_min,"
                    . "stock = :stock, "
                    . "idunid = :unid, "
                    . "precio = :pre, "
                    . "precio_venta = :prev "
                    . "where "
                    . "codproducto = :p_cp";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cp", $this->getCodigoProducto());
            $sentencia->bindParam(":nom_prod", $this->getNombreProd());
            $sentencia->bindParam(":stock_min", $this->getStockMin());
            $sentencia->bindParam(":stock", $this->getStock());
            $sentencia->bindParam(":unid", $this->getUnidad());
            $sentencia->bindParam(":pre", $this->getPrecio());
            $sentencia->bindParam(":prev", $this->getPrecioVenta());
            $sentencia->execute();

            $this->dblink->commit();
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;
        
    }
    
    public function obtenerEstado(){
        try {
            
            $sql="select cast(estado as text) from producto where codproducto = :p_cp";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cp", $this->getCodigoProducto());
            $sentencia->execute();         
            
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            $estado = $resultado["estado"];
            
            
            if($estado === "A"){
                $this->setEstado("N");
            }  else {
                $this->setEstado("A");
            }
            
            return $this->getEstado();
            
        } catch (Exception $exc) {
             throw $exc;
        }
        
    }

        public function ModificarEstado() {
        
        
        try {
        
            
            $sql="select cast(estado as text) from producto where codproducto = :p_cp";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cp", $this->getCodigoProducto());
            $sentencia->execute();         
            
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            
            $estado = $resultado["estado"];
            
            
            if($estado === 'A'){
                $this->setEstado('N');
            }  else {
                $this->setEstado('A');
            }
            
//            $NE = "nuevo estado: "+$nestado+" " ;
            
            $sql = "update producto "
                    . "set "
                    . "estado = :pn_est "
                    . "where "
                    . "codproducto = :p_cp";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cp", $this->getCodigoProducto());
            $sentencia->bindParam(":pn_est", $this->getEstado());
            $sentencia->execute();

        } catch (Exception $exc) {
           
            throw $exc;
        }
        
        return true;
        
    }
    
    
    public function leerDatos($codigo) {
        try {
            $sql = "
                select * from producto where codproducto = :p_cp
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
            $sql = "delete from producto where codproducto = :p_cp";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cp", $this->getCodigoProducto());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }
        
        return true;
    }
    
   /* public function buscarArea($nombreArea) {
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
    */
    
    
    public function obtenerProducto($NomProducto) {
        try {
            $sql = "select p.codproducto,p.nombre, p.stock, u.nombre as unidad,p.idunid as idunidad  from producto p inner join unidad_medida u on p.idunid = u.idunid
 where upper(p.nombre) like :p_nom and estado like 'A'";
            $sentencia = $this->dblink->prepare($sql);
            $NomProducto = '%'.strtoupper($NomProducto).'%';
            $sentencia->bindParam(":p_nom", $NomProducto);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
            
    }
    
public function listarReporte(/*$cod_Area*/) {
        try {
//            if($cod_Area== null || $cod_Area==''){
//                $cod_Area=0;
//                $this->setCodigoArea($cod_Area);
//            }else{
//                $this->setCodigoArea($cod_Area);
//            }
            $sql = "select p.codproducto, p.nombre, p.stock, um.nombre as unidad, p.estado,p.precio
                    ,coalesce(ingresos.cantidad,0) - coalesce(salidas.cantidad,0)  as stock_actual
                    from producto p inner join unidad_medida um on p.idunid = um.idunid 
                    left join(
                        select ds.codproducto, sum(ds.cantidad) as cantidad
                        from salida s inner join detallesalida ds on ds.codigo_sal=s.codigo_sal
                        where s.estado=1
                        group by ds.codproducto
                    )salidas on salidas.codproducto=p.codproducto
                    left join(
                        select di.codproducto, sum(di.cantidad) as cantidad 
                        from ingreso i inner join detalleingreso di on di.codigo_ing=i.codigo_ing
                        where i.estado=1
                        group by di.codproducto
                    )ingresos on ingresos.codproducto=p.codproducto
                    order by 6, 1

";
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":cod_area", $this->getCodigoArea());
            $sentencia->execute();

            $registros = $sentencia->fetchAll();

            return $registros;
        } catch (Exception $exc) {
            throw $exc;
        }

        
    }

    public function listarMovimientos($codproducto) {
        try {
//            if($cod_Area== null || $cod_Area==''){
//                $cod_Area=0;
//                $this->setCodigoArea($cod_Area);
//            }else{
//                $this->setCodigoArea($cod_Area);
//            }
            $sql = "
                select
                s.fecha ,ds.codproducto, ds.cantidad*-1 as cantidad,ds.precio,a.nombre--, ds.*,s.*
                from salida s inner join detallesalida ds on ds.codigo_sal=s.codigo_sal
                inner join area a on a.codigo_area=s.codigo_area
                inner join usuario u on u.codigo_usuario=s.usuario_area 
                inner join personal p on p.dni=u.dni_usuario
                inner join unidad_medida uni on uni.idunid=ds.idunidad
                where s.estado=1 and ds.codproducto=".$codproducto."
                UNION ALL
                select
                i.fecha ,di.codproducto, di.cantidad,di.precio,pro.razonsocial
                from ingreso i inner join detalleingreso di on di.codigo_ing=i.codigo_ing
                inner join proveedor pro on pro.codproveedor=i.codproveedor
                inner join unidad_medida uni on uni.idunid=di.idunidad
                where i.estado=1 and di.codproducto=".$codproducto."
                order by fecha

            ";
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":cod_area", $this->getCodigoArea());
            $sentencia->execute();

            $registros = $sentencia->fetchAll();

            return $registros;
        } catch (Exception $exc) {
            throw $exc;
        }

        
    }

}
