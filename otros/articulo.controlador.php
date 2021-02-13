<?php
    require_once '../negocio/Articulo.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    $codigo_marca = $_POST["p_codigo_marca"];
    
    $objArea = new Area();
    
    try {
        $registros = $objArea->listarArea($codigo_marca);
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
?>

<table id="tbl-listado" class="table table-bordered table-striped">
    <thead>
            <tr>
                    <th>CODIGO</th>
                    <th>NOMBRE</th>
                    <th>PRECIO</th>
                    <th>MARCA</th>
            </tr>
    </thead>
    <tbody>
            <?php
                for ($i = 0; $i < count($registros); $i++) {
                    echo '<tr>';
                        echo '<td>'.$registros[$i]["codigo"].'</td>';
                        echo '<td>'.$registros[$i]["nombre"].'</td>';
                        echo '<td>'.$registros[$i]["precio"].'</td>';
                        echo '<td>'.$registros[$i]["marca"].'</td>';
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
            </tr>
    </tfoot>
</table>
    
    

    