<?php session_start(); 

require_once '../negocio/Usuario.class.php';
require_once '../util/funciones/Funciones.class.php';
$objProducto = new Usuario();
try {   $data = $Producto->stock_minimo();  } 
catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }
$rows=array(); 
$record = 0;
for ($i = 0; $i < count($registros); $i++) 
    {
	  $data['title'] = $registros[$i]['producto'];
	    $data['msg'] = $registros[$i]['stock'];
	   $data['icon'] = 'images/avatar.png';
	    $data['url'] = 'https://www.baulphp.com';
	         $rows[] = $data;
	        $nextime = date('Y-m-d H:i:s',strtotime(date('Y-m-d H:i:s'))+($registros[$i]['stock']*60));        
        $record++;
	}
$array['notif'] = $rows;
$array['count'] = $record;
$array['result'] = true;
echo json_encode($array);
//----------------------------------------------------------
?>