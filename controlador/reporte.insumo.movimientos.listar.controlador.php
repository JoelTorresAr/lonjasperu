<?php
require_once '../negocio/Producto.class.php';
require_once '../util/funciones/Funciones.class.php';

$datosDetalle = $_POST["p_json_datos_detalle"];
$datosDetalle = json_decode($datosDetalle,true);

$objProducto = new Producto();
try {
    $registros = $objProducto->listarMovimientos($datosDetalle[0]["codproducto"]);
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}
?>

<table id="tabla-divInsumos" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>FECHA</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
            <th>REFERENCIA</th>
            


        </tr>
    </thead>
    <tbody>

        <?php
        for ($i = 0; $i < count($registros); $i++) {
            if ($registros[$i]["cantidad"]<0) {
                echo '<tr style="color:red;">';                 
            } else{
                echo '<tr>';
            }
            echo '<td>' . $registros[$i]["fecha"] . '</td>';
            echo '<td>' . $registros[$i]["cantidad"] . '</td>';
            echo '<td>' . $registros[$i]["precio"] . '</td>';
            echo '<td>' . $registros[$i]["nombre"] . '</td>';
           echo '</tr>';
        }
        ?>

    </tbody>

</table>



