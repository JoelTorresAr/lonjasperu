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
    <title>Hierro Perú / Registro de Pedidos</title>
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
        include 'almacenero_cabecera.php';
      ?>

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
            Cambiar Contraseña
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-home"></i> Principal</a></li>
            <li><a href="#">Administracion</a></li>
            <li class="active">Contraseña</li>
          </ol>
        </section>

        <!-- Main content -->
        <section class="content">
          <div class="row">
            <div class="col-xs-12">
                <form id="frmgrabar">
              <div class="box box-primary">
                <div class="box-body">
                    <div class="form-group" id="frmconfirmar-pass">
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="txtpass-1">Ingrese su Contraseña</label>
                                <input type="password" class="form-control" name="txtpass-1" id="txtpass-1" placeholder="Contraseña" required="">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="txtpass-2">Confirme una vez más su Contraseña</label>
                                <input type="password" class="form-control" name="txtpass-2" id="txtpass-2" placeholder="Contraseña" required="">
                            </div>
                        </div>
                        <span id="msj-ayuda-exito" class="hidden help-block">contraseñas coinciden</span>
                        <span id="msj-ayuda-error" class="hidden help-block">contraseñas no coinciden</span>
                    </div>   
                                                
                    
                </div><!-- /.box-header -->
                
              </div><!-- /.box -->
              
              <div class="box box-success">
                  <div class="box-body">
                      <div class="row">
                            <div class="form-group col-lg-3">
                                <label for="txtpass-3">Ingrese su nueva Contraseña</label>
                                <input type="password" class="form-control" name="txtpass-3" id="txtpass-3" placeholder="Contraseña" required="">
                            </div>
                        </div>
                      <div class="row">
                            <div class="col-lg-3">
                                <button type="button" class="btn btn-primary btn-sm"  id="btnlimpiar">Limpiar</button>
                                
                                &nbsp;
                                <button type="submit" class="btn btn-success btn-sm"  id="btnactualizar">Actualizar</button>
                            </div>
                        </div>
                  </div>
              </div>
              </form>
              
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
    
    <script src="js/cambiar-contrasena.js"></script>
    
  </body>
</html>