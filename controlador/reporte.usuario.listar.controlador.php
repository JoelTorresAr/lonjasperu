<?php
require_once '../negocio/Usuario.class.php';
require_once '../util/funciones/Funciones.class.php';



$objUsuario = new Usuario();
try {
    $registros = $objUsuario->listar();
} catch (Exception $exc) {
    Funciones::mensaje($exc->getMessage(), "e");
}
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>ESTADO</th>
            <th>DNI</th>
            <th>NOMBRE</th>
            <th>DIRECCIÓN</th>
            <th>TELÉFONO</th>
            <th>EMAIL</th>
            <th>CARGO</th>
            <th>ÁREA</th>


        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < count($registros); $i++) {
            
            echo '<tr>';
            echo '<td>';
            
            if($registros[$i]["estado"]=="A")
                echo 'ACTIVO';
            else {
                echo 'INACTIVO';
            }
            
            echo '</td>';
            echo '<td>' . $registros[$i]["dni"] . '</td>';
            echo '<td>' . $registros[$i]["nombre"] . '</td>';
            echo '<td>' . $registros[$i]["direccion"] . '</td>';
            echo '<td>' . $registros[$i]["telefono"] . '</td>';
            echo '<td>' . $registros[$i]["email"] . '</td>';
            echo '<td>' . $registros[$i]["cargo"] . '</td>';
            echo '<td>' . $registros[$i]["area"] . '</td>';
            echo '</tr>';
        }
        ?>

    </tbody>

</table>




