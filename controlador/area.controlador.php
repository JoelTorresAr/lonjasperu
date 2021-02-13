<?php

    require_once '../negocio/Area.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    
    
    $objArea = new Area();
    try {
        $registros = 
                $objArea->listarArea();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
            <tr>
                    <th>CODIGO</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>ENCARGADO</th>
                    <th>&nbsp;</th>
                    
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i=0; $i<count($registros);$i++) { 
                echo '<tr>';
                    echo '<td>'.$registros[$i]["codigo_area"].'</td>';
                    echo '<td>'.$registros[$i]["nombre"].'</td>';
                    echo '<td>'.$registros[$i]["descripcion"].'</td>';
                    echo '<td>'.$registros[$i]["encargado"].'</td>';
                    echo '
                        <td>
                            <a href="javascript:void();" onclick = "editar('.$registros[$i]["codigo_area"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit text-green"></i></a>
                            <a href="javascript:void();" onclick = "eliminar('.$registros[$i]["codigo_area"].')"><i class="fa fa-trash text-orange"></i></a>
                        </td>
                        ';
                echo '</tr>';
            }
        ?>
        
    </tbody>
    <tfoot>
            <tr>
                    <th>CODIGO</th>
                    <th>NOMBRE</th>
                    <th>DESCRIPCION</th>
                    <th>ENCARGADO</th>
                    <th>&nbsp;</th>
            </tr>
    </tfoot>
</table>

    
    
    
    