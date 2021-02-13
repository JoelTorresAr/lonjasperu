<?php  

    require_once '../negocio/Usuario.class.php';
    require_once '../util/funciones/Funciones.class.php';
    $objUsuario = new Usuario();
    try {   $data_prov = $objUsuario-> listar_pedidos();  } 
    catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }

    session_name("sistema-comercial");
    session_start();
    $_SESSION["titulo_reporte"]=utf8_decode("Relación de Pedidos");

    include 'plantilla_reporte.php';
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',8);
            $pdf->Cell(10,6,'NRO',1,0,'C',1);
             $pdf->Cell(15,6,'Codigo',1,0,'C',1);
             $pdf->Cell(60,6,'Usuario',1,0,'C',1);
             $pdf->Cell(20,6,'Fecha',1,0,'C',1);
             $pdf->Cell(15,6,'Estado',1,1,'C',1);

    
    $pdf->SetFont('Arial','',8);
    
for($i = 0; $i < count($data_prov); $i++)
    {
            $pdf->Cell(10,6,$i+1,1,0,'C');
            $pdf->Cell(10,6,$data_prov[$i]['pedido.codpedido'],1,0,'C');
            $pdf->Cell(70,6,utf8_decode($data_prov[$i]['nombre_usuario'])  ,1,0,'C');
            $pdf->Cell(20,6,$data_prov[$i]['to_char'],1,0,'C');
            $pdf->Cell(20,6,$data_prov[$i]['estado'],1,1,'R');
             
    }
    $pdf->Output();
die();

?>