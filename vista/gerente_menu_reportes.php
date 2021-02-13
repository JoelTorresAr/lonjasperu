<section class="sidebar">
    <!-- Sidebar user panel -->
    
    <!-- search form -->
    
<!--    <form action="#" method="get" class="sidebar-form">
      <div class="input-group">
        <input type="text" name="q" class="form-control" placeholder="Buscar"/>
        <span class="input-group-btn">
          <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    </form>-->

    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">


 <div class="user-panel" >
       <div class="pull-left image">
    <center><img src="../imagenes/1.png" class="img-circle" alt="User Image" style="float: left;width:28px;height:28px;border-radius:50%;margin-right:10px;margin-top:-2px;"></center>


    


        </div>
        <div class="pull-left info">
          <p><?php echo $nombreUsuario; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>




      <li class="header">Menú Principal</li>
      <link href="../imagenes/logo.png" rel="shortcut icon" type="image/x-icon"/>








<!--      <li class="treeview" id="matenimiento-tree">
        <a href="#">
          <i class="fa fa-edit" ></i> <span>Mantenimientos</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul  style="visibility:hidden" class="treeview-menu">
          <li><a href="#"><i class="fa fa-ticket"></i> Líneas de artículos</a></li>
          <li><a href="#"><i class="fa fa-tags"></i> Categorías de artículos</a></li>
          <li><a href="producto.php"><i class="fa fa-coffee"></i> Insumo</a></li>
          <li class="menu-division"></li>
          <li><a href="#"><i class="fa fa-map-marker"></i> Ubigeo</a></li>
          <li><a href="#"><i class="fa fa-sitemap"></i> Zonas</a></li>
          <li><a href="#"><i class="fa fa-male"></i> Clientes</a></li>
          <li class="menu-division"></li>
          
         <li><a href="#"><i class="fa fa-crosshairs"></i> Cargos</a></li>
          <li><a href="area.php"><i class="fa fa-qrcode"></i> Áreas</a></li>
          <li><a href="cargo.php"><i class="fa fa-qrcode"></i> Cargo</a></li>
          <li><a href="#"><i class="fa fa-users"></i> Personal</a></li>
          <li class="menu-division"></li>
          
          <li><a href="proveedor.php"><i class="fa fa-cogs"></i> Proveedor</a></li>
          <li><a href="#"><i class="fa fa-archive"></i> Sucursales</a></li>
          <li><a href="#"><i class="fa fa-qrcode"></i> Almacenes</a></li>
        </ul>
      </li>-->

<!--      <li class="treeview transacciones-tree" >
        <a href="#">
          <i class="fa fa-laptop"></i>
          <span>Transacciones</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul style="visibility:hidden" class="treeview-menu">
            <li><a href="compras-listado.php"><i class="fa fa-shopping-cart"></i> Compras</a></li>
            <li><a href="pedido-listado.php"><i class="fa fa-money"></i>Pedidos</a></li>
            <li><a href="devoluciones-listado.php"><i class="fa fa-angle-left"></i>Devoluciones</a></li>
        </ul>
      </li>-->

      <li class="treeview">
        <a href="#">
            <i class="fa fa-book"></i> <span>Reportes</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
            <li><a href="gerente_rpt_grafico1.php" ><i class="fa fa-file-text"></i> Reporte con grafico 1</a></li>
          <li class="menu-division"></li>
          <li><a href="gerente_rpt_grafico2.php"><i class="fa fa-file-text"></i> Reporte con grafico 2</a></li>
          <li class="menu-division"></li>
          <li><a href="gerente_rpt_grafico3.php"><i class="fa fa-file-text"></i> Reporte con grafico 3</a></li>
          <li class="menu-division"></li>
          <li><a href="gerente_rpt_grafico4.php"><i class="fa fa-file-text"></i> Reporte con grafico 4</a></li>
          <li class="menu-division"></li>
          <li><a href="gerente_rpt_grafico5.php"><i class="fa fa-file-text"></i> Reporte con grafico 5</a></li>
          <li class="menu-division"></li>
          <li><a href="gerente_rpt_proveedores.php" target="_blank"><i class="fa fa-file-text"></i> Reporte de Proveedores</a></li>
          <li class="menu-division"></li>
          <li><a href="gerente_rpt_compras.php" target="_blank"><i class="fa fa-file-text"></i> Reporte de Compras</a></li>
          <li class="menu-division"></li>
          <li><a href="gerente_rpt_insumos.php" target="_blank"><i class="fa fa-file-text"></i> Reporte de Insumos</a></li>
          <li class="menu-division"></li>
          <li><a href="#" target="_blank"><i class="fa fa-file-text"></i> Reporte Bincard</a></li>
          <li class="menu-division"></li>
          
        </ul>
        <a href="#">
            <i class="fa fa-book"></i> <span>Usuarios</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="gerente_usuario.php"><i class="fa fa-file-text"></i>Usuarios</a></li>
          <li class="menu-division"></li>
        </ul>
        <a href="#">
            <i class="fa fa-book"></i> <span>Contraseña</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="gerente_cambiar-contrasena.php"><i class="fa fa-file-text"></i>Cambiar Contraseña</a></li>
          <li class="menu-division"></li>
        </ul>
      </li>

<!--      <li class="treeview">
        <a href="#">
          <i class="fa fa-bar-chart-o"></i> <span>Reportes Estadísticos</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul class="treeview-menu">
          <li><a href="#"><i class="fa fa-file-text"></i> Compras</a></li>
          <li><a href="#"><i class="fa fa-file-text"></i> Ventas</a></li>
        </ul>
      </li>-->

<!--      <li class="treeview">
        <a href="#">
          <i class="fa fa-gears"></i> <span>Administración</span>
          <i class="fa fa-angle-left pull-right"></i>
        </a>
        <ul style="visibility:hidden" class="treeview-menu">
            <li><a href="usuario.php"><i class="fa fa-user"></i> Usuarios</a></li>
            <li><a href="cambiar-contrasena.php"><i class="fa fa-key"></i> Cambiar Contraseña</a></li>
        </ul>
      </li>-->

    </ul>
</section>