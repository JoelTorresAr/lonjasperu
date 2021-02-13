<?php  

    require_once '../negocio/Usuario.class.php';
    require_once '../util/funciones/Funciones.class.php';
    $objUsuario = new Usuario();
    try {   $data_prov = $objUsuario-> listar_compras();  } 
    catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }

    session_name("sistema-comercial");
    session_start();
    $_SESSION["titulo_reporte"]=utf8_decode("Relación de Compras");

    include 'plantilla_reporte.php';
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    $pdf->SetFillColor(232,232,232);
    $pdf->SetFont('Arial','B',8);
            $pdf->Cell(10,6,'NRO',1,0,'C',1);
             $pdf->Cell(10,6,'Tipo',1,0,'C',1);
             $pdf->Cell(15,6,'Numero',1,0,'C',1);
             $pdf->Cell(70,6,'Proveedor',1,0,'C',1);
             $pdf->Cell(20,6,'Fecha',1,0,'C',1);
             $pdf->Cell(20,6,'Neto',1,0,'C',1);
             $pdf->Cell(20,6,'IGV',1,0,'C',1);
             $pdf->Cell(20,6,'Total',1,1,'C',1);
    
    
    $pdf->SetFont('Arial','',8);
    
for($i = 0; $i < count($data_prov); $i++)
    {
            $pdf->Cell(10,6,$i+1,1,0,'C');
            $pdf->Cell(10,6,$data_prov[$i]['tipocomprobante'],1,0,'C');
            $pdf->Cell(15,6,$data_prov[$i]['nrocomprobante']         ,1,0,'C');                   
            $pdf->Cell(70,6,utf8_decode($data_prov[$i]['razonsocial'])  ,1,0,'C');
            $pdf->Cell(20,6,$data_prov[$i]['to_char'],1,0,'C');
            $pdf->Cell(20,6,$data_prov[$i]['neto'],1,0,'R');
            $pdf->Cell(20,6,$data_prov[$i]['igv_compra'],1,0,'R');
            $pdf->Cell(20,6,$data_prov[$i]['total'],1,1,'R');
             
    }
    $pdf->Output();
die();

?>