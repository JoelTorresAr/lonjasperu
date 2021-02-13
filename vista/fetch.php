<?php
require_once '../negocio/Usuario.class.php';
require_once '../util/funciones/Funciones.class.php';
$objUsuario = new Usuario();
try {   $data = $objUsuario->stock_minimo();  } 
catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }
$output='';
$cantidad=0;
if(count($data)>0)      
  {
      for($i = 0; $i < count($data); $i++)
         {    
            $cantidad=$cantidad+1;
            $output .= '
            <li>
            <a href="view.php?id=' . $data[$i]["stock"] . '">
                         <strong>' . $data[$i]["producto"] . '</strong><br />
                      <small><em>' . $data[$i]["medida"] . '</em></small>
            </a>
            </li>
            ';
        }
  }
else
    {    $output .= '<li><a href="#" class="text-bold text-italic">No hay notificaciones</a></li>';   }    

        $data = array('notification' => $output,'unseen_notification' => $cantidad);   
echo json_encode($data);
?>

