<?php  

    require_once '../negocio/Usuario.class.php';
    require_once '../util/funciones/Funciones.class.php';
    $objUsuario = new Usuario();
    try {   $data_prov = $objUsuario-> listar_usuarios();  } 
    catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }

    session_name("sistema-comercial");
    session_start();
    $_SESSION["titulo_reporte"]=utf8_decode("Relación de Usuarios");

    include 'plantilla_reporte.php';
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',8);
             $pdf->Cell(10,6,'NRO',1,0,'C',1);
             $pdf->Cell(19,6,'DNI',1,0,'C',1);
             $pdf->Cell(63,6,'NOMBRE DE USUARIO',1,0,'C',1);
             $pdf->Cell(70,6,'EMAIL',1,0,'C',1); 
             $pdf->Cell(20,6,'ESTADO',1,1,'C',1); 
    $pdf->SetFont('Arial','',8);
    
for($i = 0; $i < count($data_prov); $i++)
    {      
                                                     $pdf->Cell(10,6,$i+1,1,0,'C');
                           $pdf->Cell(19,6,$data_prov[$i]['dni']         ,1,0,'C');                    
                           $pdf->Cell(63,6,utf8_decode($data_prov[$i]['nombre_usuario']),1,0,'L');   
             $pdf->Cell(70,6,utf8_decode($data_prov[$i]['correo'])  ,1,0,'L');
             $pdf->Cell(20,6,utf8_decode($data_prov[$i]['estado'])  ,1,1,'C');
             
    }
    $pdf->Output();
die();

?>

- reporte de los usuarios

 dni/nombre del usuario/direccion del cliente/telefono/email de acceso/estado del usuario(activo o inactivo)




                    
              