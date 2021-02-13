<header class="main-header">

    <a href="administrador_menu.php" class="logo"><b>Gestion de Almacen</b></a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" role="navigation">

      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <!-- Notifications: style can be found in dropdown.less -->
          <!-- Tasks: style can be found in dropdown.less -->

          <!-- User Account: style can be found in dropdown.less -->



<div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
         
          <!-- Notifications: style can be found in dropdown.less -->
         
          <!-- Tasks: style can be found in dropdown.less -->
       









<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

 <script>
$(document).ready(function(){
 
 function load_unseen_notification(view = '')
 {
  $.ajax({
   url:"./fetch.php",
   method:"POST",
   data:{view:view},
   dataType:"json",
   success:function(data)
   {
    $('.menu').html(data.notification);
    if(data.unseen_notification > 0)
    {
     $('.count').html(data.unseen_notification);
    }
   }
  });
 }
 
 load_unseen_notification(); 
 $(document).on('click', '.dropdown-toggle', function(){ $('.count').html('');load_unseen_notification('yes'); }); 
 setInterval(function(){ load_unseen_notification();  }, 5000);
 
});
</script>



   <li class="dropdown tasks-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-flag-o"></i>              
<span class="label label-pill label-danger count" style="border-radius:10px;"></span> 
         <span class="glyphicon glyphicon-bell" style="font-size:18px;"></span>


            </a>

            <ul class="dropdown-menu">
              <li class="header">Listado de insumos</li>
              <li>
                <!-- inner menu: contains the actual data -->
                <ul class="menu">                
            
                </ul>
              </li>
              <li class="footer">
                <a href="#">Mostrar todos los insumos</a>
              </li>
            </ul>







          </li>
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="../imagenes/1.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $nombreUsuario; ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="../imagenes/1.png" class="img-circle" alt="User Image">

                <p>
                  <?php echo $nombreUsuario; ?>
                  <small><?php echo $cargo; ?></small>
                </p>
              </li>
              <!-- Menu Body -->
              <li class="user-body">
                <div class="row">
                  <div class="col-xs-12 text-center">
                    <a href="#"><i class="fa fa-key text-primary"></i> <span class="text-primary">Cambiar mi contraseña</span></a>
                  </div>
                 
                 
                </div>
                <!-- /.row -->
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-default btn-flat">Mi Perfil</a>
                </div>
                <div class="pull-right">
                  <a href="../controlador/cerrarSesion.php" class="btn btn-default btn-flat">Cerrar Sesión</a>
                </div>
              </li>
            </ul>
          </li>
          <!-- Control Sidebar Toggle Button -->
         
        </ul>
      </div>

















        </ul>
      </div>
    </nav>
</header>