<?php

require_once '../negocio/Sesion.class.php';
require_once '../util/funciones/Funciones.class.php';

$email      = $_POST["txtemail"];
$clave      = $_POST["txtclave"];
//$cargo		= $_POST["txtcargo"]; //linea agregada

if(isset($_POST["chkrecordar"]))
  {    $recordar   = $_POST["chkrecordar"];}
else
    {  $recordar   = "N";  }

$objSesion = new Sesion();
$objSesion->setEmail($email);
$objSesion->setClave($clave);
//$objSesion->setCargo($cargo); //linea modificada
$objSesion->setRecordar($recordar);

try 
    {  $resultado = $objSesion->iniciarSesion();  }
catch (Exception $exc) 
      {
           //Imprimir el error
           Funciones::mensaje($exc->getMessage(),"e","../vista/index.php",5);
      }

switch ($resultado)
       {
       	//-------------------------------------------------------------------------------------------------------------
	    //case 1: header("location:../vista/principalgerencia.php");break;
	    case 2: Funciones::mensaje("El usuario se encuentra inactivo","a","../vista/index.php",10);break;				
        case 3:  header("location:../vista/gerente_menu.php");break;
        case 4: header("location:../vista/almacenero_menu.php");break;
        case 5: header("location:../vista/administrador_menu.php");break;
        case 6:  header("location:../vista/fundicion_menu.php");break;
	    //case 7: header("location:../vista/principalgerencia.php");break;
	    //-------------------------------------------------------------------------------------------------------------	
	    default:Funciones::mensaje("El email del usuario o la contraseña son incorrectos","e","../vista/index.php",5);
       }

