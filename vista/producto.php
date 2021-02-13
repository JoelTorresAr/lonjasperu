<?php  date_default_timezone_set("America/Lima");  ?>
<?php
    session_name("sistema-comercial");
    session_start();    
    if( ! isset($_SESSION["usuario"])){
        header("location:index.php");
    }
        
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

  </head>
  <body class="skin-green">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <?php   include 'almacenero_cabecera.php';    ?>
      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php
            include 'almacenero_menu_reportes.php';
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
                        Mantenimiento de Insumo
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
                        <li><a href="#">Mantenimiento</a></li>
                        <li class="active">Insumo</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

                    <!-- INICIO del formulario modal -->
                    <form name="frmgrabar" id="frmgrabar" method="post" action="/">
                        <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Agregar nuevo Insumo</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><input type="hidden" name="txttipooperacion" id="txttipooperacion" class="form-control" required=""><p>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <label>Código</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <p><input type="text" name="txtcodigo" id="txtcodigo" class="form-control" placeholder="Código" readonly=""></p>
                                            </div>
                                        </div>
                                         <div class="row">
                                            <div class="col-xs-2">
                                                <label>Nombre</label>
                                            </div>
                                            <div class="col-xs-10">
                                                <p><input type="text" name="txtnombre" id="txtnombre" class="form-control" placeholder="Nombre del Producto" required=""><p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <!-- <div class="col-xs-2">
                                                <label>Stock Mínimo</label>
                                            </div>
                                            <div class="col-xs-2">
                                                <p><input type="number" name="txtstockmin" id="txtstockmin" class="form-control" placeholder="stock min" required=""><p>
                                            </div> -->
                                           <!--  <div class="col-xs-1">
                                                <label>Stock</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <input type="number" name="txtstock" id="txtstock" class="form-control" placeholder="Cantidad" required="">
                                            </div> -->
                                            <div class="col-xs-2">
                                                <label>Unidad</label>
                                            </div>
                                            <div class="col-xs-3">
                                                <select class="form-control" name="cmb-descripcion" id="cmb-descripcion" required="" >

                                                </select>
                                            </div>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-xs-2">
                                                <label>Precio Costo</label>
                                            </div>
                                            <div class="col-xs-6">
                                               <input type="number" name="txtcosto" id="txtcosto" class="form-control" placeholder="Precio de costo" required="">
                                            </div>
                                           
                                        </div>
                                        <div class="row">
                                           
                                            <div class="col-xs-2">
                                                <label>Precio Venta</label>
                                            </div>
                                            <div class="col-xs-6">
                                               <input type="number" name="txtventa" id="txtventa" class="form-control" placeholder="Precio de venta" required="">
                                            </div>
                                        </div> -->
                                        
                                        <!--<p><label for="imagen">Ingrese Imagen</label><input type="file" id="archivoImagen"></p>-->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger" aria-hidden="true">Aceptar</button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrar">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- FIN del formulario modal -->


                    <!-- INICIO del formulario modal--> 

                    <form name="frmmostrar" id="frmmostrar" method="post" action="/">
                        <div class="modal fade" id="proveedor-data" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">Insumo: <span id="nom-insumo"></span></h4>
                                    </div>
                                    <div class="modal-body">
                                        <p><input type="hidden" name="txttipoinsumo" id="txttipoinsumo" class="form-control" required=""><p>
                                        <div class="row">
                                            <div class="col-xs-12">
                                                <div id="detalle">

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="modal-footer">
                                        <input type="hidden" id="cod_insumo" value="" >
                                        <input type="hidden" id="index" value="" >                          
                                        <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrar">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </form>

                    <!-- FIN del formulario modal-->


                    <div class="row">
                        <div class="col-xs-12">
                            <div class="box box-primary">
                                <div class="box-body">                    
                                    <form>
                                        <div class="row">
                                            <div class="col-xs-2">
                                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#myModal" onclick="agregar()">Agregar</button>
                                            </div>
                                        </div>
                                    </form>                    
                                </div> <!--/.box-header -->

                            </div><!-- /.box -->

                            <div class="box">
                                <div class="box-body">
                                    <div id="listado">





                                    </div>
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
        <strong>
        Copyright &copy; <?php echo date('Y'); ?> <a href="#">Sistema de Almacen de Hierro Perú Maquinarias S.R.L.</a>.
        </strong> Todos los derechos reservados.
      </footer>
    </div><!-- ./wrapper -->    
       
        <script src="../util/jquery/jquery.min.js"></script>       
        <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>       
        <script src="../util/lte/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
        <script src="../util/lte/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>       
        <script src="../util/lte/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
        <script src='../util/lte/plugins/fastclick/fastclick.min.js'></script>      
        <script src="../util/lte/js/app.js" type="text/javascript"></script> 
        <script src="js/producto.js"></script>
  </body>
</html>