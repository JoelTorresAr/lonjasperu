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
    <title>Mantenimiento de Artículos</title>
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
    
    <!-- AutoCompletar-->
    <link href="../util/jquery/jquery.ui.css" rel="stylesheet">

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
        <!-- INICIO del formulario -->
        
        <form id="frmgrabar">
            
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      Registro de Compras
                    </h1>
                    <ol class="breadcrumb">
                        <button type="submit" class="btn btn-danger btn-sm">Registrar la Compra</button>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">


                    <div class="box box-default">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Nº Compra</label>
                                        <input type="text" class="form-control input-sm" maxlength="8" id="txtnro" name="txtnro" required="" />
                                      </div>
                                  </div>

                                  <div class="col-xs-3">
                                      <div class="form-group">
                                        <label>Fecha de Compra</label>
                                        <input type="date" class="form-control input-sm" id="txtfec" name="txtfec" required="" value="<?php echo date('Y-m-d'); ?>"/>
                                      </div>
                                  </div>

                                  <div class="col-xs-3">
                                        <label>T. de Comprobante</label>
                                    <div class="form-group">
                                        <select class="form-control" name="tipoComprobante" required="">
                                          <option value="F">Factura</option>
                                          <option value="B">Boleta</option>
                                        </select>
                                    </div>
                                  </div>


                              </div><!-- /row -->
                              <div class="row">
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                        <label>Proveedor (Digite las iniciales de la razón social)</label>
                                        <input type="text" class="form-control input-sm" id="txtproveedor" required="">
                                        <input type="hidden" id="txtcodprov" name="txtcodprov">
                                      </div>
                                  </div>
                                  <div class="col-xs-6">
                                      <div class="form-group">
                                        <label>Dirección:</label>
                                        <input type="text" class="form-control input-sm" id="lbldireccionproveedor" readonly="">
                                      </div>
                                  </div>
                                  
                              </div>
                              
                          <!-- /row -->
                          </div><!-- /.box-header -->
                    </div><!-- /.box -->

                    <div class="box box-default">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-xs-4">
                                      <div class="form-group">
                                        <label>Digite las iniciales de un artículo</label>
                                        <input type="text" class="form-control input-sm" id="txtproducto" />
                                        <input type="hidden" id="txtcodigoproducto" />
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Precio</label>
                                        <input type="number" min="0" value="0" class="form-control input-sm" id="txtprecio" />
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Cantidad</label>
                                        <input type="number" min="0" value="0" class="form-control input-sm" id="txtcantidad" />
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>Unidad</label>
                                        <input type="text" class="form-control input-sm" id="txtunidad" readonly="" />
                                        <input type="hidden" class="form-control input-sm" id="txtidunidad" readonly="" />
                                      </div>
                                  </div>
                                  <div class="col-xs-2">
                                      <div class="form-group">
                                        <label>&nbsp;</label>
                                        <br>
                                        <button type="button" class="btn btn-success btn-sm" id="btnagregar">Agregar</button>
                                      </div>
                                  </div>
                              </div>
                              <div class="row">
                                  <div class="col-xs-12">
                                      <table id="tabla-listado" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>CÓDIGO</th>
                                                <th>ARTÍCULO</th>
                                                <th style="text-align: right">PRECIO</th>
                                                <th style="text-align: right">CANTIDAD</th>
                                                <th style="text-align: right">IMPORTE</th>
                                                <th>&nbsp;</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody id="detallecompra">

                                        </tbody>
                                            
                                        
                                        
                                    </table>
                                  </div>
                              </div>
                          </div>
                    </div>
                    <div class="box box-danger">
                          <div class="box-body">
                              <div class="row">
                                  <div class="col-xs-3">
                                      
                                  </div>
                                  <div class="col-xs-3">
                                      
                                  </div>
                                  <div class="col-xs-3">
                                      
                                  </div>
                                  <div class="col-xs-3">
                                      <div class="input-group">
                                        <span class="input-group-addon">NETO:</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimporteneto" name="txtimporteneto" readonly="" style="width: 68%;"/>
                                      </div>
                                      <div class="input-group">
                                        <span class="input-group-addon">IGV <span id="txtigv" name="txtigv">18</span>% :</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimporteigv" name="txtimporteigv" readonly="" style="width: 63%;"/>
                                      </div>
                                      <div class="input-group">
                                        <span class="input-group-addon">TOTAL:</span>
                                        <input type="text" class="form-control text-right text-bold" id="txtimportetotal" name="txtimportetotal" readonly="" style="width: 66%;"/>
                                      </div>
                                  </div>
                              </div>
                          </div>
                    </div>
                </section><!-- /.content -->
                
                
                
          </div><!-- /.content-wrapper -->
        </form>
        <!-- FIN del formulario -->
        
    <!-- FIN: Contenido de la página -->

      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; <?php echo date('Y'); ?> <a href="#">Sistema Comercial</a>.</strong> Todos los derechos reservados.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.3 -->
    <script src="../util/jquery/jquery.min.js"></script>
    <!-- Bootstrap 3.3.2 JS -->
    <script src="../util/bootstrap/js/bootstrap.js" type="text/javascript"></script>
    
    <!-- AutoCompletar -->
    <script src="../util/jquery/jquery.ui.autocomplete.js"></script>
    <script src="../util/jquery/jquery.ui.js"></script>
    <script src="js/compras-autocompletar.js?y=52"></script>
    
    
    <script src="js/compras.js?b=53"></script>
    <script src="js/util.js"></script>
    
    
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
    <!-- <script src="../util/lte/js/demo.js" type="text/javascript"></script> -->
    
    
    <script>
        function disableselect(e){
            return false;
        }
        function reEnable(){
            return true;
        }
        document.onselectstart=new Function ("return false")
        if (window.sidebar){
            document.onmousedown=disableselect
            document.onclick=reEnable
        }
    </script>
    
  </body>
</html>