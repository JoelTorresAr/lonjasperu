<?php

    require_once '../negocio/Abc.class.php';
    require_once '../util/funciones/Funciones.class.php';

    $fecha1 = $_POST["p_fecha1"];
    $fecha2 = $_POST["p_fecha2"];
    $objAbc = new Abc();

    try {
        $registros = $objAbc->listar($fecha1, $fecha2);
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>

    <table id="tabla-listado" class="table table-bordered table-striped">
        <thead>
                <tr>    
                        
                        <th>CODIGO</th>
                        <th>INSUMO</th>
                        <th>PARTICIPACIÓN</th>
                        <th>PART. ACUMULADA</th>
                        <th>CATEGORÍA</th>
                        
                </tr>
        </thead>
        <tbody id="datos-detalle">
            <?php
                $a=0;
                $b=0;
                $c=0;
                for ($i=0; $i<count($registros);$i++) {

                    if (floatval($registros[$i][7] )>=0.951) {
                        $categoria='C';
                        $c=$c+1;
                    }elseif (floatval($registros[$i][7] )>=0.851) {
                        $categoria='B';
                        $b=$b+1;
                    }else {
                        $categoria='A';
                        $a=$a+1;
                    }
                    echo '<tr>';           
                    echo '<td id="cod_compra'.$i.'">'.$registros[$i][0].'</td>';
                    // echo '<td align="center">
                    //                 <a href="javascript:void();" data-toggle="modal" data-target="#myModal" onclick = "detalles('.$i.');"><i id="ojo" class="fa fa-eye text-green"></i></a>
                    //      </td>';
                    echo '<td>'.$registros[$i][1].'</td>';
                    echo '<td>'.$registros[$i][5].'</td>';
                    echo '<td>'.$registros[$i][7].'</td>'; 
                    echo '<td>'.$categoria.'</td>';           
                    
                    echo '</tr>';
                        
                }
            ?>

        </tbody>

    </table>
    <?php
        echo '<input type="hidden" id="hddA" value="' . $a.'">';
        echo '<input type="hidden" id="hddB" value="' . $b.'">';
        echo '<input type="hidden" id="hddC" value="' . $c.'">';
    ?>

      