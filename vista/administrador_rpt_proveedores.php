<?php  

    require_once '../negocio/Usuario.class.php';
    require_once '../util/funciones/Funciones.class.php';
    $objUsuario = new Usuario();
    try {   $data_prov = $objUsuario-> listar_proveedores();  } 
    catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }

    session_name("sistema-comercial");
    session_start();
    $_SESSION["titulo_reporte"]=utf8_decode("Relación de Proveedores");

    include 'plantilla_reporte.php';
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',8);
             $pdf->Cell(10,6,'NRO',1,0,'C',1);
             $pdf->Cell(23,6,'RUC',1,0,'C',1);
    $pdf->Cell(120,6,'RAZON SOCIAL',1,1,'C',1);
    
    
    $pdf->SetFont('Arial','',8);
    
for($i = 0; $i < count($data_prov); $i++)
    {
      
                                                     $pdf->Cell(10,6,$i+1,1,0,'C');
                           $pdf->Cell(23,6,$data_prov[$i]['ruc']         ,1,0,'C');                    
             $pdf->Cell(120,6,utf8_decode($data_prov[$i]['razonsocial'])  ,1,1,'L');
             
    }
    $pdf->Output();
die();

?>





                    
              