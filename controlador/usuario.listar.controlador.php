<?php
require_once '../negocio/Usuario.class.php';
require_once '../util/funciones/Funciones.class.php';

session_name("sistema-comercial");
session_start();
$codigo = $_SESSION["cod_usuario"];


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
            <th>DIRECCION</th>
            <th>TELEFONO</th>
            <th>EMAIL</th>
            <th>CARGO</th>
            <th>AREA</th>


        </tr>
    </thead>
    <tbody>
        <?php
        for ($i = 0; $i < count($registros); $i++) {
            if ($registros[$i]["estado"] == "I") {
                echo '<tr style="color:red">';
            } else {
                echo '<tr>';
            }
            echo '<td>';
            echo '&nbsp;';
            echo '&nbsp;';
            echo '<a href="javascript:void();" data-toggle="modal" data-target="#myModal" onclick = "editar(' . $registros[$i]["dni"] . ')"><i class="fa fa-edit text-green"></i></a>';
            echo '&nbsp;';
            echo '&nbsp;';
            echo '&nbsp;';
            
            if ($codigo == $registros[$i]["idusuario"]) {
                
            } else {
                if ($registros[$i]["estado"] == "I") {
                    echo '<a href="javascript:void();" onclick = "estado(' . $registros[$i]["dni"] . ')"><i class="fa fa-check text-green"></i></a>';
                    
                } else {
                    echo '<a href="javascript:void();" onclick = "estado(' . $registros[$i]["dni"] . ')"><i class="fa fa-ban text-orange"></i></a>';
//                    echo '<a href="javascript:void();" data-toggle="modal" data-target="#myModal" onclick = "editar(' . $registros[$i]["dni"] . ')"><i class="fa fa-edit text-orange"></i></a>';
                }
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

<script type="text/javascript">
    $(document).ready(function(){
        $('#tabla-listado').DataTable();
    });
</script>




