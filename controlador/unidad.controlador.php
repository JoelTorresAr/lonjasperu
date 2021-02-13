<?php

    require_once '../negocio/Unidad.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    
    
    $objUnidad = new Unidad();
    try {
        $registros = 
                $objUnidad->listarUnidad();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
            <tr>
                    <th>CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th>&nbsp;</th>
                    
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i=0; $i<count($registros);$i++) { 
                echo '<tr>';
                    echo '<td>'.$registros[$i]["idunid"].'</td>';
                    echo '<td>'.$registros[$i]["nombre"].'</td>';
                    echo '
                        <td>
                            <a href="javascript:void();" onclick = "editar('.$registros[$i]["idunid"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit text-green"></i></a>
                            <a href="javascript:void();" onclick = "eliminar('.$registros[$i]["idunid"].')"><i class="fa fa-trash text-orange"></i></a>
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
    