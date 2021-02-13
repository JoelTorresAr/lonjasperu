<?php

require_once '../datos/conexion.php';

class Sesion extends Conexion {
    private $email;
    private $clave;
    private $recordar;
    
    public function getRecordar() {
        return $this->recordar;
    }

    public function setRecordar($recordar) {
        $this->recordar = $recordar;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getClave() {
        return $this->clave;
    }
    //linea inicio agregada 
    public function getCargo() {
        return $this->cargo;
    }

    public function setCargo($cargo) {
        $this->cargo = $cargo;
    }
    // linea final agregada

    public function setEmail($email) {
        $this->email = $email;
    }
    
    public function setClave($clave) {
        $this->clave = $clave;
    }

        
    public function iniciarSesion() {
        try {
            $sql = " select 
                            u.codigo_usuario,
                            u.clave,
                            u.estado,
                            p.apellido_paterno as paterno,
                            p.apellido_materno as materno,
                            p.nombres as nombres,
                            c.descripcion as cargo
                     from
                        usuario u 
                        inner join personal p on ( u.dni_usuario = p.dni )
                        inner join cargo c on ( c.codigo_cargo = p.codigo_cargo )
                     where
                        p.email = :p_email
                ";
            $sentecia = $this->dblink->prepare($sql);
            $sentecia->bindParam(":p_email", $this->getEmail());
            $sentecia->execute();
            $RData = $sentecia->fetch();

            if ($RData["clave"] == md5($this->getClave()))
               {
                    if ($RData["estado"] == "I")
                       {     return 2;       }
                    else
                        {
                            session_name("sistema-comercial");
                            session_start();
                            $_SESSION["cod_usuario"] = $RData["codigo_usuario"];
                            $_SESSION["usuario"] = $RData["nombres"].' '.$RData["paterno"].' '.$RData["materno"];
                            $_SESSION["cargo"] = $RData["cargo"];                                                    
                            //---------------------------------------------------------------------- 
                            if ($this->getRecordar()=="S")
                               {   setcookie("emailusuario", $this->getEmail(), 0, "/");   }
                            else
                                {  setcookie("emailusuario", "", 0, "/");                  } 
                            //-----------------------------------------------------------------------
                            if ($RData["cargo"]=="CONTADOR PRINCIPAL")
                               {    return 1;   }
                            elseif ($RData["cargo"]=="JEFE DE SISTEMAS")
                                {   return 3;   }
                            elseif ($RData["cargo"]=="ALMACENERO")
                                 {  return 4;   }
                            elseif ($RData["cargo"]=="ADMINISTRADOR")
                                 {  return 5;   }
                            elseif ($RData["cargo"]=="VENDEDOR")
                                 {  return 6;   }
                            elseif ($RData["cargo"]=="MASTER")
                                 {  return 7;   }
                            //----------------------------------------------------------------------                           
                        }
                }
            return -1;
        } 
        catch (Exception $exc) 
              {   throw $exc;    }
    }


    
}
