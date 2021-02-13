<?php

    require_once '../negocio/Articulo.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    $codigo_marca       = $_POST["p_codigo_marca"];
    $codigo_linea       = $_POST["p_codigo_linea"];
    $codigo_categoria   = $_POST["p_codigo_categoria"];
    
    $objArea = new Area();
    try {
        $registros = 
                $objArea->listarArea(
                            $codigo_marca,
                            $codigo_linea,
                            $codigo_categoria
                        );
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
            <tr>
                    <th>CODIGO</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>MARCA</th>
                    <th>LINEA</th>
                    <th>CATEGORIA</th>
                    <th>&nbsp;</th>
                    
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i=0; $i<count($registros);$i++) { 
                echo '<tr>';
                    echo '<td>'.$registros[$i]["codigo"].'</td>';
                    echo '<td>'.$registros[$i]["nombre"].'</td>';
                    echo '<td>'.$registros[$i]["precio"].'</td>';
                    echo '<td>'.$registros[$i]["marca"].'</td>';
                    echo '<td>'.$registros[$i]["linea"].'</td>';
                    echo '<td>'.$registros[$i]["categoria"].'</td>';
                    echo '
                        <td>
                            <a href="javascript:void();" onclick = "editar('.$registros[$i]["codigo"].')" data-toggle="modal" data-target="#myModal"><i class="fa fa-edit text-green"></i></a>
                            <a href="javascript:void();" onclick = "eliminar('.$registros[$i]["codigo"].')"><i class="fa fa-trash text-orange"></i></a>
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
                    <th>PRECIO</th>
                    <th>MARCA</th>
                    <th>LINEA</th>
                    <th>CATEGORIA</th>
                    <th>&nbsp;</th>
            </tr>
    </tfoot>
</table>

    
    
    
    