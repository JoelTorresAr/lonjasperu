<?php
    date_default_timezone_set("America/Lima");
?>

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
    <title>Hierro Perú / Devolucion</title>
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
  </head>
  <body class="skin-green">
    <!-- Site wrapper -->
    <div class="wrapper">
      
      <?php
        include 'cabecera.php';
      ?>

      <!-- =============================================== -->

      <!-- Left side column. contains the sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <?php
            include 'menualmacen.php';
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
            Registro de Devoluciones
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
            <li><a href="#">Transacciones</a></li>
            <li class="active">Devoluciones</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
              <div class="box box-primary">
                <div class="box-body">
                    <form class="form-inline">
                        <div class="row">
                            <div class="col-xs-12">
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="rbtipo" id="rbtipo" value="1" >
                                      Solo Hoy
                                    </label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="radio">
                                    <label>
                                      <input type="radio" name="rbtipo" id="rbtipo" value="2">
                                      Rango de Fechas
                                    </label>
                                </div>
                                &nbsp;&nbsp;
                                <div class="radio">
                                    <label>
                                      <input type="radio" name="rbtipo" id="rbtipo" value="3" checked="" >
                                      Todas las Fechas
                                    </label>
                                </div>
                            </div>
                        </div>
                        &nbsp;
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-7">
                                <div class="col-xs-6">
                                <div class=" input-group">
                                    <label>Desde:&nbsp;</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                          <span class="text-blue"><i class="fa fa-calendar"></i></span>
                                      </div>
                                      <input type="date" id="txtfecha1" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>"/>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                </div>
                                <div class="col-xs-6">
                                <div class="input-group">
                                    <label>Hasta:&nbsp;</label>
                                    <div class="input-group">
                                      <div class="input-group-addon">
                                        <span class="text-blue"><i class="fa fa-calendar"></i></span>
                                      </div>
                                      <input type="date" id="txtfecha2" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>"/>
                                    </div><!-- /.input group -->
                                </div><!-- /.form group -->
                                </div>
                            </div>
                            
                            <div class="visible-xs col-xs-12 visible-sm col-sm-12 hidden-lg hidden-md">
                                <br>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-5">
                                
                                
                                <button type="button" class="btn btn-primary btn-sm"  id="btnfiltrar">Filtrar Datos</button>
                                
                                
                                <button type="button" class="btn btn-danger btn-sm"  id="btnagregar">Agregar Nueva Devolucion</button>
                            </div>
                        </div>
                    </form>
                </div><!-- /.box-header -->
                
              </div><!-- /.box -->
              
              <div class="box">
                <div class="box-body">
                    
                    <!-- INICIO del formulario modal -->
        <form name="frmgrabar" id="frmgrabar" method="post" action="/">
                <div class="modal fade" id="myModal" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title" id="myModalLabel"></h4>
                      </div>
                      <div class="modal-body">
                          <p><input type="hidden" name="txttipooperacion" id="txttipooperacion" class="form-control" required=""><p>
                          <div class="row">
                            <div class="col-xs-12">
                                <div id="detalle">
                        
                                </div>
                            </div>
                          </div>
                           
                      </div>
                      <div class="modal-footer">
                          <button type="submit" class="hidden btn btn-danger" aria-hidden="true">Aceptar</button>
                          <button type="button" class="btn btn-default" data-dismiss="modal" id="btncerrar">Cancelar</button>
                      </div>
                    </div>
                  </div>
                </div>
            </form>
        <!-- FIN del formulario modal -->
                    
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
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Sistema de Almacen de Hierro Perú Maquinarias S.R.L.</a>.</strong> Todos los derechos reservados.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../util/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    
    <!-- DATA TABLE -->
    <script src="../util/lte/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="../util/lte/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

    <!-- SlimScroll -->
    <script src="../util/lte/plugins/slimScroll/jquery.slimScroll.min.js" type="text/javascript"></script>
    <!-- FastClick -->
    <script src='../util/lte/plugins/fastclick/fastclick.min.js'></script>
    <!-- AdminLTE App -->
    <script src="../util/lte/js/app.js" type="text/javascript"></script>
    <!-- Temas -->
    <!--<script src="../util/lte/js/demo.js" type="text/javascript"></script>-->
    
    <script src="js/devoluciones-listar.js"></script>
    
  </body>
</html>