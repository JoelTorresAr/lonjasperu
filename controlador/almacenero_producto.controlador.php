<?php

    require_once '../negocio/Producto.class.php';
    require_once '../util/funciones/Funciones.class.php';
    
    
    
    $objProducto = new Producto();
    try {
        $registros = 
                $objProducto->listarProducto();
    } catch (Exception $exc) {
        Funciones::mensaje($exc->getMessage(), "e");
    }
    
?>

<table id="tabla-listado" class="table table-bordered table-striped">
    <thead>
            <tr>
                    <th>CODIGO</th>                    
                    <th>NOMBRE</th>
                    <th>DETALLE</th>
                    <!-- <th>&nbsp;</th> -->
                    
            </tr>
    </thead>
    <tbody>
        <?php
            for ($i=0; $i<count($registros);$i++) { 
                if ($registros[$i]["estado"]=="N"){
                        echo '<tr style="color:red">';
                            
                    }else{
                        echo '<tr>';
                            
                    }
                    $ID_PROD=$registros[$i]["codproducto"];
                    echo '<td>'.$registros[$i]["codproducto"].'</td>';                    
                    echo '<td>'.$registros[$i]["nombre"].'</td>';
    echo '<td align = "center"> 
            <a  target="_blank" href="rpt_6.php?id='.$ID_PROD.'">
                <i id="ojo-insumo" class="fa fa-eye text-blue"> </i></a></td>';
                    
                    
                        
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
    
    
    
    