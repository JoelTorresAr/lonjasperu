<?php
// Queremos hacer en pdf la factura numero 1 de la tipica BBDD de facturacion
require 'fpdf/fpdf.php';
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial','B',10);

// Imprimimos el logo a 300 ppp
$pdf->Image('../imagenes/logo.png',10,10,-300);
//$pdf->Cell(120,10, $_SESSION["titulo_reporte"],0,0,'C');

    require_once '../negocio/Usuario.class.php';
    require_once '../util/funciones/Funciones.class.php';
    $objUsuario = new Usuario();
    $codproducto = $_GET["id"];
    // var_dump($codproducto);
    try {
       $data_prov = $objUsuario-> bincard($codproducto);  
       $data_prod = $objUsuario-> obtenerInsumo($codproducto); 
        // var_dump($data_prod) ;
        $nombre_prod = $data_prod["nombre"];
        $codigo_prod = $data_prod["codigo"];
        $unidad_prod = $data_prod["unidad"];
        $stock_prod = $data_prod["stock"];
   } 
    catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }

    session_name("sistema-comercial");
    session_start();
    $_SESSION["titulo_reporte"]=utf8_decode("Reporte Bincard");

// // Consulta a la base de datos para sacar cosas de la factura 1
// $c=mysql_connect("127.0.0.1","root","root");
// mysql_select_db("facturitas");

// $orden1="SELECT nombre,direccion,nif,fecha,num_fact
// FROM clientes,facturas
// WHERE clientes.cod_cli=facturas.cod_cli
// AND facturas.num_fact=1";
// $paquete1=mysql_query($orden1);
// $reg1=mysql_fetch_array($paquete1);

// $orden2="SELECT denominacion,precio,cantidad
// FROM articulos,lineas_factura
// WHERE lineas_factura.cod_art=articulos.cod_art
// AND lineas_factura.num_fact=1";
// $paquete2=mysql_query($orden2);

// mysql_close($c);

// 1º Datos del cliente
$texto1="Insumo: ".$nombre_prod."\nCodigo: ".$codigo_prod."\nUnidad de Medida: ".$unidad_prod;
$pdf->SetXY(30, 50);
$pdf->MultiCell(140,10,$texto1,1,"L");

// 2º Datos de la factura (fecha y numero de factura)
// $texto2="Factura número: ".$reg1[4]." de fecha: ".$reg1[3];
// $pdf->SetXY(25, 90);
// $pdf->Cell(150,10,$texto2,1,0,"C");

// 3º Una tabla con los articulos comprados


// $pdf->SetXY(20, 30);
// $pdf->SetFillColor(0,255,0);
// $pdf->SetTextColor(0,0,0);
// $pdf->Cell(60,10,"Insumo:",1,0,"C",true);
// $pdf->SetY(40);
// $pdf->Cell(60,10,"Codigo:",1,0,"C",true);
// $pdf->SetX(50);
// $pdf->Cell(60,10,"Unidad de medida:",1,0,"C",true);

// La cabecera de la tabla (en negro sobre fondo verde)
$pdf->SetXY(30, 120);
$pdf->SetFillColor(0,255,0);
$pdf->SetTextColor(0,0,0);
$pdf->Cell(10,10,'Nro',1,0,'C',1);
$pdf->Cell(40,10,"Condicion",1,0,"C",true);
$pdf->Cell(35,10,"Fecha",1,0,"C",true);
$pdf->Cell(40,10,"Documento",1,0,"C",true);
$pdf->Cell(30,10,"Cantidad",1,1,"C",true);
$total=0;

// Los datos (en negro)
$pdf->SetTextColor(0,0,0);

for($i = 0; $i < count($data_prov); $i++)
    {
            $pdf->SetX(30);
            $pdf->Cell(10,10,$i+1,1,0,'C');
            $pdf->Cell(40,10,$data_prov[$i]['condicion'],1,0,"C");
            $pdf->Cell(35,10,$data_prov[$i]['fecha'],1,0,"C");
            $pdf->Cell(40,10,$data_prov[$i]['documento'],1,0,"C");
            $pdf->Cell(30,10,$data_prov[$i]['cantidad'],1,1,"C");
            // $pdf->Cell(20,10,number_format($reg2[1],2),1,0,"C");
            // $pdf->Cell(30,10,number_format(($reg2[2]*$reg2[1]),2),1,1,"R");
            // $total+=($reg2[2]*$reg2[1]);
             
    }


// 4º Los totales, IVAs y demás
$pdf->SetX(115);
$pdf->Cell(40,10,"Stock Actual",1,0,"C");
$pdf->Cell(30,10,number_format($stock_prod,2),1,1,"C");
// $pdf->SetX(120);
// $pdf->Cell(50,10,"IVA (4%): ",1,0,"C");
// $pdf->Cell(30,10,number_format(0.04*$total,2),1,1,"R");
// $pdf->SetX(120);
// $pdf->Cell(50,10,"Total:",1,0,"C");
// $pdf->Cell(30,10,number_format(1.04*$total,2),1,1,"R");

// El documento enviado al navegador
 $pdf->Output();
?>

<!-- http://www.v-espino.com/~chema/daw2/factura_en_pdf.htm -->