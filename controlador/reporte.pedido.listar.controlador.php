<?php
require_once '../negocio/Pedido.class.php';
require_once '../util/funciones/Funciones.class.php';

$listar = $_POST["p_listar"];

$objPedido = new Pedido();
try {
        $registros = $objPedido->listar(date('d-m-Y'), date('d-m-Y'), "3");
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
        <tr>
            
            <th>CODIGO</th>
            <th>DETALLE</th>
            <th>NOMBRE USUARIO</th>
            <th>AREA</th>
            <th>CARGO</th>
            <th>FECHA</th>
            <th>ESTADO</th>


        </tr>
    </thead>
    <tbody>
        <?php
        
        for ($i = 0; $i < count($registros); $i++) {
            
            if($listar== "1"){
                
                if($registros[$i][5]=="Atendido"){
                    
                    echo '<tr>';
                    echo '<td id="cod_ped'.$i.'">'.$registros[$i][0].'</td>';
                    echo '<td><a href="javascript:void();" data-toggle="modal" data-target="#myModal" onclick = "detalles('.$i.');"><i id="ojo" class="fa fa-eye text-green"></i></a></td>';
                    echo '<td id="nombre'.$i.'">'.$registros[$i][1].'</td>';
                    echo '<td>'.$registros[$i][2].'</td>';
                    echo '<td>'.$registros[$i][3].'</td>';
                    echo '<td>'.$registros[$i][4].'</td>';
                    echo '<td id="estado'.$i.'">'.$registros[$i][5].'</td>';
                    echo '</tr>';
                }
                
                
            }  else {
                if($registros[$i][5]!="Atendido"){
                    
                    echo '<tr>';
                    echo '<td id="cod_ped'.$i.'">'.$registros[$i][0].'</td>';
                    echo '<td><a href="javascript:void();" data-toggle="modal" data-target="#myModal" onclick = "detalles('.$i.');"><i id="ojo" class="fa fa-eye text-green"></i></a></td>';
                    echo '<td id="nombre'.$i.'">'.$registros[$i][1].'</td>';
                    echo '<td>'.$registros[$i][2].'</td>';
                    echo '<td>'.$registros[$i][3].'</td>';
                    echo '<td>'.$registros[$i][4].'</td>';
                    echo '<td id="estado'.$i.'">'.$registros[$i][5].'</td>';
                    echo '</tr>';
                }
            }
            
            
        }
        ?>

    </tbody>

</table>




