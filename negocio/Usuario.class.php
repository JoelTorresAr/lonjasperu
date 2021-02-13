<?php

require_once '../datos/conexion.php';

class Usuario extends Conexion {

    private $dni;
    private $nombre;
    private $ape_mat;
    private $ape_pat;
    private $direccion;
    private $email;
    private $teleono;
    private $celular;
    private $cargo;
    private $area;
    private $clave;
    private $estado;

    public function getEstado() {
        return $this->estado;
    }

    public function setEstado($estado) {
        $this->estado = $estado;
    }

    public function getDni() {
        return $this->dni;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getApe_mat() {
        return $this->ape_mat;
    }

    public function getApe_pat() {
        return $this->ape_pat;
    }

    public function getDireccion() {
        return $this->direccion;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getTeleono() {
        return $this->teleono;
    }

    public function getCelular() {
        return $this->celular;
    }

    public function getCargo() {
        return $this->cargo;
    }

    public function getArea() {
        return $this->area;
    }

    public function getClave() {
        return $this->clave;
    }

    public function setDni($dni) {
        $this->dni = $dni;
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }

    public function setApe_mat($ape_mat) {
        $this->ape_mat = $ape_mat;
    }

    public function setApe_pat($ape_pat) {
        $this->ape_pat = $ape_pat;
    }

    public function setDireccion($direccion) {
        $this->direccion = $direccion;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setTeleono($teleono) {
        $this->teleono = $teleono;
    }

    public function setCelular($celular) {
        $this->celular = $celular;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }

    public function setArea($area) {
        $this->area = $area;
    }

    public function setClave($clave) {
        $this->clave = $clave;
    }

    public function agregar() {
        try {

            $sql = "insert into personal 
                (dni,apellido_paterno,apellido_materno,nombres,direccion,telefono_movil1,email,codigo_cargo,codigo_area)
                values (:p_dni,:p_ape_p,:p_ape_m,:p_nom,:p_dir,:p_tel,:p_email,:p_cod_car,:p_cod_area)";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $this->getDni());
            $sentencia->bindParam(":p_ape_p", $this->getApe_pat());
            $sentencia->bindParam(":p_ape_m", $this->getApe_mat());
            $sentencia->bindParam(":p_nom", $this->getNombre());
            $sentencia->bindParam(":p_dir", $this->getDireccion());
            $sentencia->bindParam(":p_tel", $this->getTeleono());
            $sentencia->bindParam(":p_email", $this->getEmail());
            $sentencia->bindParam(":p_cod_car", $this->getCargo());
            $sentencia->bindParam(":p_cod_area", $this->getArea());
            $sentencia->execute();

            $sql = "select max(codigo_usuario)+1 as nu from usuario";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            $nuevoUsuario = $resultado["nu"];


            $sql = "insert into usuario (codigo_usuario,dni_usuario,clave,estado) VALUES (:p_cu,:p_dni,md5(:p_clave),'A')";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cu", $nuevoUsuario);
            $sentencia->bindParam(":p_dni", $this->getDni());
            $sentencia->bindParam(":p_clave", $this->getClave());
            $sentencia->execute();

            return true;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    
    
    
    public function editar() {
        $this->dblink->beginTransaction();
        
        try {
            
            $sql = "update personal "
                    . "set "
                    . "nombres = :p_nombre, "
                    . "apellido_paterno = :p_ape_p,"
                    . "apellido_materno = :p_ape_m,"
                    . "direccion = :p_direccion, "
                    . "telefono_movil1 = :p_telefono, "
                    . "email = :p_email, "
                    . "codigo_cargo = :p_cargo, "
                    . "codigo_area = :p_area "
                    . "where "
                    . "dni = :p_dni";
            
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $this->getDni());
            $sentencia->bindParam(":p_area", $this->getArea());
            $sentencia->bindParam(":p_cargo", $this->getCargo());
            $sentencia->bindParam(":p_email", $this->getEmail());
            $sentencia->bindParam(":p_telefono", $this->getTeleono());
            $sentencia->bindParam(":p_direccion", $this->getDireccion());
            $sentencia->bindParam(":p_ape_m", $this->getApe_mat());
            $sentencia->bindParam(":p_ape_p", $this->getApe_pat());
            $sentencia->bindParam(":p_nombre", $this->getNombre());
            $sentencia->execute();

            $this->dblink->commit();
            
        } catch (Exception $exc) {
            $this->dblink->rollBack();
            throw $exc;
        }
        
        return true;
        
    }
    
    
    
    
    

    public function obtenerUsuario($NomUsuario) {
        try {
            $sql = "SELECT 
  u.codigo_usuario, p.dni, p.nombres||' '||p.apellido_paterno||' '||p.apellido_materno as nombre
FROM 
  usuario as u join 
  personal as p
on 
  p.dni = u.dni_usuario
where 
  upper(p.nombres||' '||p.apellido_paterno||' '||p.apellido_materno ) like :p_nom";
            $sentencia = $this->dblink->prepare($sql);
            $NomUsuario = '%' . strtoupper($NomUsuario) . '%';
            $sentencia->bindParam(":p_nom", $NomUsuario);
            $sentencia->execute();
            $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
    public function obtenerContrasena($codusu) {
        try {
            $sql = "select * from usuario where codigo_usuario = :p_codusu";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codusu", $codusu);
            $sentencia->execute();
            $resultado = $sentencia->fetch();

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    

    public function listar() {
        try {

            $sql = "select 
	p.dni, 
	u.codigo_usuario as idusuario,
	upper(p.nombres||' '||p.apellido_paterno||' '||p.apellido_materno) as nombre, 
	upper(p.direccion) as direccion,
	p.telefono_movil1 as telefono,
	p.email,
	upper(c.descripcion) as cargo,
	upper(a.nombre) as area,
	u.estado
from 
	personal p 
	inner join cargo c on (p.codigo_cargo = c.codigo_cargo)
	inner join area a on (p.codigo_area = a.codigo_area)
	inner join usuario u on (p.dni = u.dni_usuario)
order by
	1";
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":cod_area", $this->getCodigoArea());
            $sentencia->execute();

            $registros = $sentencia->fetchAll();
            return $registros;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function ModificarEstado() {


        try {


            $sql = "select estado from usuario where dni_usuario = :p_dni";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $this->getDni());
            $sentencia->execute();

            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);

            $estado = $resultado["estado"];


            if ($estado === 'A') {
                $this->setEstado('I');
            } else {
                $this->setEstado('A');
            }

//            $NE = "nuevo estado: "+$nestado+" " ;

            $sql = "update usuario "
                    . "set "
                    . "estado = :pn_est "
                    . "where "
                    . "dni_usuario = :p_dni";

            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $this->getDni());
            $sentencia->bindParam(":pn_est", $this->getEstado());
            $sentencia->execute();
        } catch (Exception $exc) {

            throw $exc;
        }

        return true;
    }

    public function leerDatos($dni) {
        try {
            $sql = "
                select 
	p.dni, 
	u.codigo_usuario as idusuario,
	upper(p.nombres) as nombre,
	upper(p.apellido_paterno) as ape_p,
	upper(p.apellido_materno) as ape_m, 
	upper(p.direccion) as direccion,
	p.telefono_movil1 as telefono,
	p.email,
	p.codigo_cargo as cargo,
	p.codigo_area as area,
	u.estado
from 
	personal p 
	inner join cargo c on (p.codigo_cargo = c.codigo_cargo)
	inner join area a on (p.codigo_area = a.codigo_area)
	inner join usuario u on (p.dni = u.dni_usuario)
where
	p.dni = :p_dni
                ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_dni", $dni);
            $sentencia->execute();
            $resultado = $sentencia->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }
    
    
    public function cambiar_clave($id_usuario,$pass){
        $sql ="update usuario "
                    . "set "
                    . "clave = md5(:p_pass) "
                    . "where "
                    . "codigo_usuario = :p_cod";
        
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_cod", $id_usuario);
            $sentencia->bindParam(":p_pass", $pass);
            $sentencia->execute();
        
    }
    
    //*************************************************************************************************
    // MAS FUNCIONES
    //*************************************************************************************************
    public function importe_x_anios() {
        try {

            $sql = "select 
                    EXTRACT(YEAR FROM fechacompra) as anio, 
                    sum(total) as total 
                    from compra
                    group by anio
                    order by anio desc";
            $sentencia = $this->dblink->prepare($sql);
            //$sentencia->bindParam(":cod_area", $this->getCodigoArea());
            $sentencia->execute();

            $registros = $sentencia->fetchAll();
            return $registros;
        } catch (Exception $ex) {
            throw $ex;
        }
    }
    //----------------------------------------------------------------
    public function listar_compras(){
        try{
            $sql = "select tipocomprobante,nrocomprobante,razonsocial,to_char(fechacompra,'DD/MM/YYYY'),neto,igv_compra,total 
                from compra inner join proveedor on compra.codproveedor = proveedor.codproveedor
                order by  fechacompra asc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            return $registros;
        }
        catch (Exception $ex) { throw $ex; }
    }
    //----------------------------------------------------------------
    public function listar_insumos(){
        try{
            $sql = "select codproducto,nombre,stock,precio,
                    case
                        when estado = 'A' then 'Activo'
                        when estado = 'I' then 'Inactivo'
                        else '-'
                        end as estado
                    from producto
                    order by nombre asc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            return $registros;
        }
        catch (Exception $ex) { throw $ex; }
    }
    //----------------------------------------------------------------
    public function listar_pedidos(){
        try{
            $sql = "select pedido.codpedido,
                    concat(personal.apellido_paterno,'/',personal.apellido_materno,'/',personal.nombres) as nombre_usuario,
                    to_char(pedido.fechapedido,'DD/MM/YYYY'),
                    case
                        when pedido.estado = 'A' then 'Atendido'
                        when pedido.estado = 'P' then 'Pendiente'
                        when pedido.estado = 'N' then 'No Atendido'
                        else '-'
                        end as estado
                    from pedido 
                    inner join usuario on pedido.codigo_usuario = usuario.codigo_usuario
                    inner join personal on pedido.codigo_usuario = personal.codpersonal
                    order by pedido.fechapedido asc
                    ";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            return $registros;
        }
        catch (Exception $ex) { throw $ex; }
    }
    //----------------------------------------------------------------
      public function listar_proveedores() 
      {
        try 
           {
            $sql = "select codproveedor,razonsocial,ruc,direccion from proveedor order by razonsocial";
            $sentencia = $this->dblink->prepare($sql);            
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            return $registros;
           } 
        catch (Exception $ex) {  throw $ex;   }
    }
    //----------------------------------------------------------------
    public function listar_pedidos_atendidos(){
        try{
            $sql = "select pedido.codpedido as codigo,
                    concat(personal.apellido_paterno,'/',personal.apellido_materno,'/',personal.nombres) as nombre_usuario,
                    to_char(pedido.fechapedido,'DD/MM/YYYY') as fecha_pedido,
                    case
                        when pedido.estado = 'A' then 'Atendido'
                        when pedido.estado = 'P' then 'Pendiente'
                        when pedido.estado = 'N' then 'No Atendido'
                        else '-'
                        end as estado
                    from pedido 
                    inner join usuario on pedido.codigo_usuario = usuario.codigo_usuario
                    inner join personal on pedido.codigo_usuario = personal.codpersonal
                    where pedido.estado = 'A'
                    order by pedido.fechapedido asc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            return $registros;
        }
        catch (Exception $ex) { throw $ex; }
    }
    //----------------------------------------------------------------
    public function listar_pedidos_pendientes(){
        try{
            $sql = "select pedido.codpedido as codigo,
                    concat(personal.apellido_paterno,'/',personal.apellido_materno,'/',personal.nombres) as nombre_usuario,
                    to_char(pedido.fechapedido,'DD/MM/YYYY') as fecha_pedido,
                    case
                        when pedido.estado = 'A' then 'Atendido'
                        when pedido.estado = 'P' then 'Pendiente'
                        when pedido.estado = 'N' then 'No Atendido'
                        else '-'
                        end as estado
                    from pedido 
                    inner join usuario on pedido.codigo_usuario = usuario.codigo_usuario
                    inner join personal on pedido.codigo_usuario = personal.codpersonal
                    where pedido.estado = 'P'
                    order by pedido.fechapedido asc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            return $registros;
        }
        catch (Exception $ex) { throw $ex; }
    }
    //----------------------------------------------------------------
    public function listar_pedidos_noatendidos(){
        try{
            $sql = "select pedido.codpedido as codigo,
                    concat(personal.apellido_paterno,'/',personal.apellido_materno,'/',personal.nombres) as nombre_usuario,
                    to_char(pedido.fechapedido,'DD/MM/YYYY') as fecha_pedido,
                    case
                        when pedido.estado = 'A' then 'Atendido'
                        when pedido.estado = 'P' then 'Pendiente'
                        when pedido.estado = 'N' then 'No Atendido'
                        else '-'
                        end as estado
                    from pedido 
                    inner join usuario on pedido.codigo_usuario = usuario.codigo_usuario
                    inner join personal on pedido.codigo_usuario = personal.codpersonal
                    where pedido.estado = 'N'
                    order by pedido.fechapedido asc";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            return $registros;
        }
        catch (Exception $ex) { throw $ex; }
    }
    //----------------------------------------------------------------   
    public function listar_usuarios() 
      {
        try 
           {
            $sql = "SELECT personal.dni as dni,
                           upper(concat(apellido_paterno,' \ ',apellido_materno,' \ ',nombres)) as nombre_usuario, 
                           email as correo,
                          case
                              when usuario.estado = 'A' then 'ACTIVO'
                              when usuario.estado = 'I' then 'INACTIVO'    
                              else '-'
                              end as estado
                           FROM  personal inner join usuario on 
                           personal.dni=usuario.dni_usuario order by apellido_paterno";
            $sentencia = $this->dblink->prepare($sql);            
            $sentencia->execute();
            $registros = $sentencia->fetchAll();
            return $registros;
           } 
        catch (Exception $ex) {  throw $ex;   }
    }
    //----------------------------------------------------------------
    public function stock_minimo() 
    {
        try 
           {
                $sql = "select producto.nombre as producto,
                               stock_min as stock,
                               unidad_medida.nombre as medida
                        from producto inner join unidad_medida on producto.idunid=unidad_medida.idunid
                        where stock >=60
                        order by producto asc";
                $stm = $this->dblink->prepare($sql);            
                $stm->execute();
                $data = $stm->fetchAll();
                return $data;
           } 
        catch (Exception $ex)
              {  throw $ex;   }
    }
    //----------------------------------------------------------------
    public function bincard($codproducto) 
    {
        try 
           {
                $sql = "(select 'Ingreso' as condicion, ingreso.fecha as fecha ,ingreso.numero_ing as documento ,detalleingreso.cantidad as cantidad
                    from ingreso inner join detalleingreso on  ingreso.codigo_ing=detalleingreso.codigo_ing where detalleingreso.codproducto=$codproducto)
                    union
                    (select 'Salida' as condicion, salida.fecha as fecha, salida.codpedido as documento, detallesalida.cantidad
                        from salida inner join detallesalida on salida.codigo_sal=detallesalida.codigo_sal
                            where detallesalida.codproducto=$codproducto)
                    order by fecha

                    ";
                $stm = $this->dblink->prepare($sql);            
                $stm->execute();
                $data = $stm->fetchAll();
                return $data;
           } 
        catch (Exception $ex)
              {  throw $ex;   }
    }
    //----------------------------------------------------------------
    public function obtenerInsumo($codproducto) {
        try {
            $sql = "select producto.nombre as nombre, producto.codproducto as codigo, unidad_medida.nombre as unidad, producto.stock as stock
                from producto 
                inner join unidad_medida on unidad_medida.idunid = producto.idunid
                where producto.codproducto =  :p_codproducto";
            $sentencia = $this->dblink->prepare($sql);
            $sentencia->bindParam(":p_codproducto", $codproducto);
            $sentencia->execute();
            $resultado = $sentencia->fetch();
            // $resultado = $sentencia->fetchAll(PDO::FETCH_ASSOC);

            return $resultado;
        } catch (Exception $exc) {
            throw $exc;
        }
    }

}