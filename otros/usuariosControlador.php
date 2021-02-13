<?php

include "../datos/usuariosDatos.php";

class usuariosControlador{
		function insertarUsuarios($usuario,$pass){
			$obj = new usuariosDatos();
			return $obj->insertarUsuarios($usuarios,$pass);
		}
		function validar($usuario,$pass){
			$obj = new usuariosDatos();
			return $obj->validar($usuarios,$pass);
		}
		function getId$usuario,$pass){
			$obj = new usuariosDatos();
			return $obj->getId($usuarios,$pass);
		}
 }
 ?>