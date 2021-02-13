<?php

    require_once '../negocio/Pedido.class.php';
    require_once '../util/funciones/Funciones.class.php';

    $codPedido = $_POST["cod_pedido"];
    $Nom_Usuario = $_POST["nom_usuario"];
    $Estado = $_POST["estado"];
    $codUsuario = $_POST["cod_user"];
    $codArea = $_POST["cod_area"];

    

    $objPedido = new Pedido();

    try {
        $registros = $objPedido->listarDetalle($codPedido);
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }

?>
    
    <h3>Usuario: <?php echo  $Nom_Usuario ?></h3>
    <br>
    <?php
    if ($Estado=="No Atendido"){
                        echo '<h4>Estado: <span style="color:red">'.$Estado.'</span></h4>';
                            
                    }elseif($Estado=="Atendido"){
                        echo '<h4>Estado: <span style="color:green">'.$Estado.'</span></h4>';
                            
                    }  else{
                        echo '<h4>Estado: <span style="color:#ff9900">'.$Estado.'</span></h4>';
                    }
    ?>
    
    <br>
    <?php
    echo ' <input type="hidden" id="codusuario" value ="'.$codUsuario.'">'; 
    echo ' <input type="hidden" id="codarea" value ="'.$codArea.'">';                           
    ?>
    <table id="tabla-detalle" class="table table-bordered table-striped">
        <thead>
                <tr>
                        
                        <th>CODIGO PROD</th>
                        <th>NOMBRE</th>
                        <th>CANT. PEDIDA</th>
                        <th>UNIDAD</th>
                        <th>STOCK</th>
                        <th>PENDIENTE</th>
                        <th>CANT. A ATENDER</th>
                        
                </tr>
        </thead>
        <tbody id="datos-detalle-detalle">
            <?php
                for ($i=0; $i<count($registros);$i++) {
                    $can = $registros[$i][6];
                    $pen = $registros[$i][5];
                    $stk = $registros[$i][4];

                    if($stk >= $pen)
                    {                        
                        $ate = $pen;
                    }else{
                        $ate = $stk; 
                    }
                    
                    if($can == $pen)
                    {
                        echo '<tr style="color:red">';
                    }elseif ($pen > 0) {
                        echo '<tr style="color:orange">';
    }
                    else{
                        echo '<tr style="color:green">';
                    }
                    
                    echo '<td id="cod_prod'.$i.'">'.$registros[$i][0].'</td>';
                    echo '<td>'.$registros[$i][1].'</td>';
                    echo '<td id="cant'.$i.'">'.$registros[$i][2].'</td>';
                    echo '<td id="uni'.$i.'">'.$registros[$i][8].'</td>';
                    echo '<td id="stock'.$i.'">'.$registros[$i][3].'</td>';
                    echo '<td id="pendiente'.$i.'">'.$registros[$i][4].'</td>';
                    echo '<td class="hidden" id="cantidad'.$i.'">'.$registros[$i][4].'</td>';
                    if($pen>0){
                        echo '<td><input type="number" class="form-control input-sm" id="txtcantAtender" max="" value="'.$ate.'"></td>';
                    }else{
                        echo '<td id="pendiente'.$i.'">'.$registros[$i][4].'</td>';
                    }
                    
                    echo '<td class="hidden" id="codunidad'.$i.'">'.$registros[$i][7].'</td>';
                    echo '<td class="hidden" id="codprecio'.$i.'">'.$registros[$i][9].'</td>';
                    echo '</tr>';
                        
                }
            ?>

        </tbody>

    </table>