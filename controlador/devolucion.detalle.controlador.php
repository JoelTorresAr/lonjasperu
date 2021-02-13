<?php

    require_once '../negocio/Devolucion.class.php';
    require_once '../util/funciones/Funciones.class.php';

    $codDevolucion= $_POST["cod_devolucion"];
    
    

    $objDevolucion = new Devolucion();

    try {
        $registros = $objDevolucion->listarDetalle($codDevolucion);
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>
    
    <table id="tabla-detalle" class="table table-bordered table-striped">
        <thead>
                <tr>
                        
                        <th>CODIGO PROD</th>
                        <th>NOMBRE</th>
                        <th>CANTIDAD</th>
                                                
                </tr>
        </thead>
        <tbody id="datos-detalle">
            <?php
                for ($i=0; $i<count($registros);$i++) {
                    
                    echo '<tr>';
                    
                    echo '<td>'.$registros[$i][0].'</td>';
                    echo '<td>'.$registros[$i][1].'</td>';
                    echo '<td>'.$registros[$i][2].'</td>';
                    
                    echo '</tr>';
                        
                }
            ?>

        </tbody>

    </table>