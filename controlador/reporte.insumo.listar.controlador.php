<?php
require_once '../negocio/Producto.class.php';
require_once '../util/funciones/Funciones.class.php';



$objProducto = new Producto();
try {
    $registros = $objProducto->listarReporte();
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>CODIGO</th>
            <th>NOMBRE</th>
            <th>STOCK ACTUAL</th>
            <th>UNIDAD</th>
            <th>PRECIO</th>
            <th>VER</th>


        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < count($registros); $i++) {
            
            echo '<tr>';
            echo '<td>' . $registros[$i]["codproducto"] . '</td>';
            echo '<td>' . $registros[$i]["nombre"] . '</td>';
            echo '<td>' . $registros[$i]["stock_actual"] . '</td>';
            echo '<td>' . $registros[$i]["unidad"] . '</td>';
            echo '<td>' . $registros[$i]["precio"] . '</td>';
            echo '<td><a href="#" data-toggle="modal" data-target="#modal" onclick="movimientos('.$registros[$i]["codproducto"].');"><i id="ojo-insumo" class="fa fa-eye text-blue"> </i></a></td>';            
            echo '</tr>';
        }
        ?>

    </tbody>

</table>




