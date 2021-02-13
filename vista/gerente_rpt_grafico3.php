<?php  date_default_timezone_set("America/Lima");  ?>

<?php
    session_name("sistema-comercial");
    session_start();
    
    if( ! isset($_SESSION["usuario"]))
      {  header("location:index.php");   }
        
    $nombreUsuario = ucwords(strtolower($_SESSION["usuario"]));
    $cargo = ucwords(strtolower($_SESSION["cargo"]));
    $codigo = $_SESSION["cod_usuario"];   
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Hierro Perú / Mantenimiento de Usuarios</title>
    <link href="../imagenes/logo.png" rel="shortcut icon" type="image/x-icon"/>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 3.3.2 -->
    <link href="../util/bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css" />
    <!-- Font Awesome Icons -->
    <link href="../util/lte/css/font-awesome.css" rel="stylesheet" type="text/css" />
    <!-- Theme style -->
    <link href="../util/lte/css/AdminLTE.css" rel="stylesheet" type="text/css" />

    <!-- DATA TABLES -->
    <link href="../util/lte/plugins/datatables/dataTables.bootstrap.css" type="text/css" rel="stylesheet"/>
    
    <!-- Extilos extras-->
    <link href="../util/lte/css/extras.css" rel="stylesheet" type="text/css" />
    
    <!-- Ionicons -->
    <link href="../util/lte/css/ionicons.css" rel="stylesheet" type="text/css" />
    
    <!-- Theme style -->
    <link href="../util/lte/skins/_all-skins.css" rel="stylesheet" type="text/css" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<style type="text/css">
${demo.css}
    </style>
    <script type="text/javascript">
$(function () {
    $('#container').highcharts({
        chart: {
            type: 'bar'
        },
        title: {
            text: 'IMPORTES DE COMPRAS POR AÑOS'
        },
        subtitle: {
            text: 'Fuente: Hierro Perú'
        },
        xAxis: {
            categories: [
<?php

    require_once '../negocio/Usuario.class.php';
    require_once '../util/funciones/Funciones.class.php';
    $objUsuario = new Usuario();
    try {   $registros = $objUsuario-> importe_x_anios();  } 
    catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }
    
    for ($i = 0; $i < count($registros); $i++) 
        {         
?>            
            ['<?php echo $registros[$i]['anio'] ?>'],
            
<?php
}
?>
            
            ],
            title: {
                text: null
            }
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Population (millions)',
                align: 'high'
            },
            labels: {
                overflow: 'justify'
            }
        },
        tooltip: {
            valueSuffix: ' millions'
        },
        plotOptions: {
            bar: {
                dataLabels: {
                    enabled: true
                }
            }
        },
        legend: {
            layout: 'vertical',
            align: 'right',
            verticalAlign: 'top',
            x: -40,
            y: 100,
            floating: true,
            borderWidth: 1,
            backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
            shadow: true
        },
        credits: {
            enabled: false
        },
        series: [{
            name: 'Year 1800',
            data: [
            <?php


 $objUsuario = new Usuario();
    try {   $reg = $objUsuario-> importe_x_anios();  } 
    catch (Exception $exc) {   Funciones::mensaje($exc->getMessage(), "e");   }
    
    for ($j = 0; $j < count($reg); $j++) 
        {    
?>          
            [<?php echo $reg[$j]['total'] ?>],
        
<?php
}
?>          
            ]
        }]
    });
});


    </script>


  </head>
  <body class="skin-green">




    <!-- Site wrapper -->
    <div class="wrapper">
      
      <script src="../util/jquery/jquery.min.js"></script> 
      <?php   include 'gerente_cabecera.php';    ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php
            include 'gerente_menu_reportes.php';
        ?>
        <!-- /.sidebar -->
      </aside>

      <!-- =============================================== -->

    <!-- INICIO: Contenido de la página -->
        <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">







        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Administrador de Reportes
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
            <li><a href="#">Reportes</a></li>
            <li class="active">Usuarios</li>
          </ol>
        </section>



        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              
              
              <div class="box box-success">
                <div class="box-body">
                    


<script src="Highcharts-4.1.5/js/highcharts.js"></script>
<script src="Highcharts-4.1.5/js/modules/exporting.js"></script>


  <div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
  
                    
                   
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->


      </div><!-- /.content-wrapper -->
    <!-- FIN: Contenido de la página -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Sistema de Almacen de Hierro Perú Maquinarias S.R.L.</a>.
        </strong> Todos los derechos reservados.
      </footer>
    </div><!-- ./wrapper -->

     <!-- jQuery 2.1.3 -->
      
        <!-- Bootstrap 3.3.2 JS -->
        <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
        
        <!-- AdminLTE App -->
        <script src="../util/lte/js/app.js" type="text/javascript"></script>
      



  </body>
</html>