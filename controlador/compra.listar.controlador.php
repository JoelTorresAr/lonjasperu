<?php

    require_once '../negocio/Compra.class.php';
    require_once '../util/funciones/Funciones.class.php';

    $fecha1 = $_POST["p_fecha1"];
    $fecha2 = $_POST["p_fecha2"];
    $tipo   = $_POST["p_tipo"];

    $objCompra = new Compra();

    try {
        $registros = $objCompra->listar($fecha1, $fecha2, $tipo);
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>

    <table id="tabla-listado" class="table table-bordered table-striped">
        <thead>
                <tr>    
                        <th>DETALLE</th>
                        <th>CODIGO</th>
                        <th>PROVEEDOR</th>
                        <th>FECHA</th>
                        <th>IMP. NETO</th>
                        <th>IGV</th>
                        <th>IMP. TOTAL</th>
                        
                </tr>
        </thead>
        <tbody id="datos-detalle">
            <?php
                for ($i=0; $i<count($registros);$i++) {
                    
                    echo '<tr>';  
                    echo '<td align="center">
                                    <a href="javascript:void();" data-toggle="modal" data-target="#myModal" onclick = "detalles('.$i.');"><i id="ojo" class="fa fa-eye text-green"></i></a>
                         </td>';
                    echo '<td id="cod_compra'.$i.'">'.$registros[$i][0].'</td>';
                    echo '<td>'.$registros[$i][1].'</td>';
                    echo '<td>'.$registros[$i][2].'</td>';
                    echo '<td>'.$registros[$i][3].'</td>';
                    echo '<td>'.$registros[$i][4].'</td>';
                    echo '<td>'.$registros[$i][5].'</td>';
                    
                    
                    echo '</tr>';
                        
                }
            ?>

        </tbody>

    </table>