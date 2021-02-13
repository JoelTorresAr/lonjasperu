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
                    <th>STOCK</th>
                    <th>STOCK MIN</th>
                    <th>UNIDAD</th>
                    
                    
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
                    echo '<td>'.$registros[$i]["codproducto"].'</td>';
                    echo '<td>'.$registros[$i]["nombre"].'</td>';
                    echo '<td>'.$registros[$i]["stock"].'</td>';
                    echo '<td>'.$registros[$i]["stock_min"].'</td>';
                    echo '<td>'.$registros[$i]["unidad"].'</td>';
                    
                        
                echo '</tr>';
            }
        ?>
        
    </tbody>
    
</table>

    
    
    
    