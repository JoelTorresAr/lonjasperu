<?php

    require_once '../negocio/Devolucion.class.php';
    require_once '../util/funciones/Funciones.class.php';

    $fecha1 = $_POST["p_fecha1"];
    $fecha2 = $_POST["p_fecha2"];
    $tipo   = $_POST["p_tipo"];

    $objDevolucion = new Devolucion();

    try {
        $registros = $objDevolucion->listar($fecha1, $fecha2, $tipo);
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>

    <table id="tabla-listado" class="table table-bordered table-striped">
        <thead>
                <tr>    
                        <th>DETALLE</th>
                        <th>CODIGO</th>
                        <th>FECHA</th>
                        <th>AREA</th>
                        <th>USUARIO</th>
                        
                </tr>
        </thead>
        <tbody id="datos-detalle">
            <?php
                for ($i=0; $i<count($registros);$i++) {
                    
                    echo '<tr>';  
                    echo '<td align="center">
                                    <a href="javascript:void();" data-toggle="modal" data-target="#myModal" onclick = "detalles('.$i.');"><i id="ojo" class="fa fa-eye text-green"></i></a>
                         </td>';
                    echo '<td id="cod_devolucion'.$i.'">'.$registros[$i][0].'</td>';
                    echo '<td>'.$registros[$i][1].'</td>';
                    echo '<td>'.$registros[$i][2].'</td>';
                    echo '<td>'.$registros[$i][3].'</td>';
                    
                    
                    echo '</tr>';
                        
                }
            ?>

        </tbody>

    </table>