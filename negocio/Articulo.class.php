<?php

require_once '../datos/conexion.php';

class Area extends Conexion {
    private $codigoArticulo;
    private $nombre;
    private $precioVenta;
    private $codigoCategoria;
    private $codigoMarca;
    
    public function getCodigoArticulo() {
        return $this->codigoArticulo;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getPrecioVenta() {
        return $this->precioVenta;
    }

    public function getCodigoCategoria() {
        return $this->codigoCategoria;
    }

    public function getCodigoMarca() {
        return $this->codigoMarca;
    }

    public function setCodigoArticulo($codigoArticulo) {
        $this->codigoArticulo = $codigoArticulo;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setPrecioVenta($precioVenta) {
        $this->precioVenta = $precioVenta;
    }

    public function setCodigoCategoria($codigoCategoria) {
        $this->codigoCategoria = $codigoCategoria;
    }

    public function setCodigoMarca($codigoMarca) {
        $this->codigoMarca = $codigoMarca;
    }
    
    public function listar($codigoMarca, $codigoLinea, $codigoCategoria) {
        try {
            $sql = "select * from f_listar_articulo( :codigo_marca, :codigo_linea, :codigo_categoria )";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":codigo_marca", $codigoMarca);
            $sentencia->bindParam(":codigo_linea", $codigoLinea);
            $sentencia->bindParam(":codigo_categoria", $codigoCategoria);
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
            $sql = "select numero+1 as nc from correlativo where tabla = 'articulo'";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            
            if ($sentencia->rowCount()){
                $nuevoCodigo = $resultado["nc"];
                $this->setCodigoArticulo($nuevoCodigo);
                
                $sql = "insert into articulo("
                        . "codigo_articulo,"
                        . "nombre,"
                        . "precio_venta,"
                        . "codigo_categoria,"
                        . "codigo_marca)"
                        . "values(:p_ca, :p_no, :p_pv, :p_cc, :p_cm)";
                $sentencia = $this->dblink->prepare($sql);
                $sentencia->bindParam(":p_ca", $this->getCodigoArticulo());
                $sentencia->bindParam(":p_no", $this->getNombre());
                $sentencia->bindParam(":p_pv", $this->getPrecioVenta());
                $sentencia->bindParam(":p_cc", $this->getCodigoCategoria());
                $sentencia->bindParam(":p_cm", $this->getCodigoMarca());
                $sentencia->execute();
                
                $sql = "update correlativo set numero = numero + 1 where tabla = 'articulo'";
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
    
    public function editar() {
        $this->dblink->beginTransaction();
        
        try {
            
            $sql = "update articulo "
                    . "set "
                    . "nombre = :p_no, "
                    . "precio_venta = :p_pv, "
                    . "codigo_categoria = :p_cc, "
                    . "codigo_marca = :p_cm "
                    . "where "
                    . "codigo_articulo = :p_ca";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_ca", $this->getCodigoArticulo());
            $sentencia->bindParam(":p_no", $this->getNombre());
            $sentencia->bindParam(":p_pv", $this->getPrecioVenta());
            $sentencia->bindParam(":p_cc", $this->getCodigoCategoria());
            $sentencia->bindParam(":p_cm", $this->getCodigoMarca());
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
                select
                        a.codigo_articulo,
                        a.nombre,
                        a.precio_venta,
                        a.codigo_categoria,
                        a.codigo_marca,
                        c.codigo_linea
                from
                        articulo a
                        inner join categoria c 
                        on ( a.codigo_categoria = c.codigo_categoria )
                where
                        a.codigo_articulo = :p_ca
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
    
    public function eliminar() {
        try {
            $sql = "delete from articulo where codigo_articulo = :p_ca";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_ca", $this->getCodigoArticulo());
            $sentencia->execute();
        } catch (Exception $exc) {
            throw $exc;
        }
        
        return true;
    }
    
    public function buscarArticulo($nombreArticulo) {
        try {
            $sql = "
                    select 
                        codigo_articulo, 
                        nombre, 
                        precio_venta 
                    from 
                        articulo 
                    where
                        upper(nombre) like :p_na
                ";
            $sentencia = $this->dblink->prepare($sql);
            $nombreArticulo = '%'.strtoupper($nombreArticulo).'%';
            $sentencia->bindParam(":p_na", $nombreArticulo);
            $sentencia->execute();
            $registros = $sentencia->fetchAll(PDO::FETCH_ASSOC);
            return $registros;
            
        } catch (Exception $exc) {
            throw $exc;
        }
    }


}
