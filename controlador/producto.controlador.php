<?php

    require_once '../negocio/Producto.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    
    
    $objProducto = new Producto();
    try {
        $registros = 
                $objProducto->listarProducto();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
            <tr>
                    <th>CODIGO</th>
                    <th>NOMBRE</th>
                    <th>STOCK</th>
                    <!-- <th>STOCK MIN</th> -->
                    <th>UNIDAD</th>
                    <!-- <th>PRECIO COSTO</th>
                    <th>PRECIO VENTA</th> -->
                    <th>&nbsp;</th>
                    
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i=0; $i<count($registros);$i++) { 
                if ($registros[$i]["estado"]=="N"){
                        echo '<tr style="color:red">';
                            
                    }else{
                        echo '<tr>';
                            
                    }
                    echo '<td>'.$registros[$i]["codproducto"].'</td>';
                    echo '<td>'.$registros[$i]["nombre"].'</td>';
                    echo '<td>'.$registros[$i]["stock"].'</td>';
                    // echo '<td>'.$registros[$i]["stock_min"].'</td>';
                    echo '<td>'.$registros[$i]["unidad"].'</td>';
                    // echo '<td>'.$registros[$i]["precio"].'</td>';
                    // echo '<td>'.$registros[$i]["precio_venta"].'</td>';
                    echo '
                        <td>
                            <a href="javascript:void();" onclick = "editar('.$registros[$i]["codproducto"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit text-green"></i></a>
                            &nbsp;';
//                    echo '<a href="javascript:void();" onclick = "eliminar('.$registros[$i]["codproducto"].')"><i class="fa fa-trash text-red"></i></a>&nbsp;';
                    
                    if ($registros[$i]["estado"]=="N"){
                        echo '<a href="javascript:void();" onclick = "estado('.$registros[$i]["codproducto"].')"><i class="fa fa-check text-green"></i></a>';
                            
                    }else{
                        echo '<a href="javascript:void();" onclick = "estado('.$registros[$i]["codproducto"].')"><i class="fa fa-ban text-orange"></i></a>';
                            
                    }
                            
                    echo '</td>';
                        
                echo '</tr>';
            }
        ?>
        
    </tbody>
    
</table>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tabla-listado').DataTable();
    });
</script>

    
    
    
    