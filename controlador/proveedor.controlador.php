<?php

    require_once '../negocio/Proveedor.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    
    
    $objProveedor = new Proveedor();
    try {
        $registros = 
                $objProveedor->listarProveedor();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
            <tr>
                    <th>CODIGO</th>
                    <th>RAZON SOCIAL</th>
                    <th>RUC</th>
                    <th>DIRECCION</th>
                    <th>&nbsp;</th>
                    
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i=0; $i<count($registros);$i++) { 
                echo '<tr>';
                    echo '<td>'.$registros[$i]["codproveedor"].'</td>';
                    echo '<td>'.$registros[$i]["razonsocial"].'</td>';
                    echo '<td>'.$registros[$i]["ruc"].'</td>';
                    echo '<td>'.$registros[$i]["direccion"].'</td>';
                    echo '
                        <td>
                            <a href="javascript:void();" onclick = "editar('.$registros[$i]["codproveedor"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit text-green"></i></a>
                            <a href="javascript:void();" onclick = "eliminar('.$registros[$i]["codproveedor"].')"><i class="fa fa-trash text-orange"></i></a>
                        </td>
                        ';
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