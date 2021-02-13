<?php

    require_once '../negocio/Pedido.class.php';
    require_once '../util/funciones/Funciones.class.php';

    $fecha1 = $_POST["p_fecha1"];
    $fecha2 = $_POST["p_fecha2"];
    $tipo   = $_POST["p_tipo"];

    $objPedido = new Pedido();

    try {
        $registros = $objPedido->listar($fecha1, $fecha2, $tipo);
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>

    <table id="tabla-listado" class="table table-bordered table-striped">
        <thead>
                <tr>
                        <th>DETALLE</th>
                        <th>CODIGO</th>
                        <th>NOMBRE USUARIO</th>
                        <th>AREA</th>
                        <th>CARGO</th>
                        <th>FECHA</th>
                        <th>ESTADO</th>
                </tr>
        </thead>
        <tbody id="datos-detalle">
            <?php
                for ($i=0; $i<count($registros);$i++) {
                    if ($registros[$i][5]=="No Atendido"){
                        echo '<tr style="color:red">';
                            
                    }elseif($registros[$i][5]=="Atendido"){
                        echo '<tr style="color:green">';
                            
                    }  else {
                        echo '<tr style="color:#ff9900">';
                    }
                    
//                    $cod_ped = $registros[$i][0];
//                    $cod_ped = $registros[$i]["0"];
                    echo '<td align="center">
                                    <a href="javascript:void();" data-toggle="modal" data-target="#myModal" onclick = "detalles('.$i.');"><i id="ojo" class="fa fa-eye text-green"></i></a>
                         </td>';
                    echo '<td id="cod_ped'.$i.'">'.$registros[$i][0].'</td>';
                    echo '<td id="nombre'.$i.'">'.$registros[$i][1].'</td>';
                    echo '<td>'.$registros[$i][2].'</td>';
                    echo '<td>'.$registros[$i][3].'</td>';
                    echo '<td>'.$registros[$i][4].'</td>';
                    echo '<td id="estado'.$i.'">'.$registros[$i][5].'</td>';
                                        
                    echo '</tr>';
                        
                }
            ?>

        </tbody>

    </table>