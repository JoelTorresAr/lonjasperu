
function listar(){
    $("#listado").empty();
    $("#listado").load("../controlador/reporte.producto.controlador.php");
    $('#tabla-listado').dataTable({
                    "aaSorting": [[1, "asc"]],
                    
                    "sScrollX":       "150%",
                    "sScrollXInner":  "100%",
                    "bScrollCollapse": true,
                    "bPaginate":       true
                });
                
//    $.post(
//            "../controlador/area.controlador.php", 
//            {} 
//        )
//            .done(function(resultado){
//                $("#listado").empty();
//                $("#listado").append(resultado);
//                $('#tabla-listado').dataTable({
//                    "aaSorting": [[1, "asc"]]
//                });
//    
//            });
};



$(document).ready(function(){
//    cargarMarca();
//    cargarLinea();


    listar();
   
    
    
});

