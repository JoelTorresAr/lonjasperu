<?php  

    require_once '../negocio/Usuario.class.php';
    require_once '../util/funciones/Funciones.class.php';
    $objUsuario = new Usuario();
    $codproducto = $_GET["id"];
    try {   $data_prov = $objUsuario-> bincard($codproducto);  } 
    catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }

    session_name("sistema-comercial");
    session_start();
    $_SESSION["titulo_reporte"]=utf8_decode("Bincard");

    include 'plantilla_reporte.php';
    $pdf = new PDF();
    $pdf->AliasNbPages();
    $pdf->AddPage();
    
    $pdf->SetFillColor(232,232,232);

    // linea de tabla para el nombre del insumo
    // $pdf->SetFont('Arial','B',8);
    //         $pdf->Cell(10,6,'Insumo',1,0,'C',1);
    //          $pdf->Cell(20,6,'Codigo',1,0,'C',1);
    //          $pdf->Cell(30,6,'Unidad de Medida',1,1,'C',1);
    
    // $pdf->SetFont('Arial','',8);
    // for($i = 0; $i < count($data_prov); $i++)
    // {
    //         $pdf->Cell(10,6,$i+1,1,0,'C');
    //         $pdf->Cell(20,6,$data_prov[$i]['nombre'],1,0,'C');
    //         $pdf->Cell(30,6,$data_prov[$i]['codproducto'],1,0,'C');
    //         $pdf->Cell(15,6,$data_prov[$i]['nombre_unidad'],1,1,'C');
    //         //$pdf->Cell(20,6,$data_prov[$i]['estado'],1,1,'R');
             
    // }
    //     $pdf->Output();
    // die();



    // tabla con los movimientos 
    $pdf->SetFont('Arial','B',8);
            $pdf->Cell(10,6,'Nro',1,0,'C',1);
            $pdf->Cell(20,6,'Condicion',1,0,'C',1);
            $pdf->Cell(20,6,'Fecha',1,0,'C',1);
            $pdf->Cell(40,6,'Documento',1,0,'C',1);
            $pdf->Cell(40,6,'Cantidad',1,1,'C',1);
             // $pdf->Cell(30,6,'Saldo Stock)',1,1,'C',1);
             //$pdf->Cell(15,6,'Estado',1,1,'C',1);

    
    $pdf->SetFont('Arial','',8);
    
for($i = 0; $i < count($data_prov); $i++)
    {
            $pdf->Cell(10,6,$i+1,1,0,'C');
            $pdf->Cell(20,6,$data_prov[$i]['condicion'],1,0,'C');
            $pdf->Cell(20,6,$data_prov[$i]['fecha'],1,0,'C');
            $pdf->Cell(40,6,$data_prov[$i]['documento'],1,0,'C');
            $pdf->Cell(40,6,$data_prov[$i]['cantidad'],1,1,'R');
             
    }
    $pdf->Output();
die();

?>