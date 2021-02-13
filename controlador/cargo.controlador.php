<?php

    require_once '../negocio/Cargo.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    
    
    $objCargo = new Cargo();
    try {
        $registros = 
                $objCargo->listarCargo();
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
                    echo '<td>'.$registros[$i]["codigo_cargo"].'</td>';
                    echo '<td>'.$registros[$i]["descripcion"].'</td>';
                    echo '
                        <td>
                            <a href="javascript:void();" onclick = "editar('.$registros[$i]["codigo_cargo"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit text-green"></i></a>
                            <a href="javascript:void();" onclick = "eliminar('.$registros[$i]["codigo_cargo"].')"><i class="fa fa-trash text-orange"></i></a>
                        </td>
                        ';
                echo '</tr>';
            }
        ?>
        
    </tbody>
    <tfoot>
            <tr>
                    <th>CODIGO</th>
                    <th>DESCRIPCION</th>
                    <th>&nbsp;</th>
            </tr>
    </tfoot>
</table>

    
    
    
    