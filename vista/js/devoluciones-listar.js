function listar(){
    var tipo = $("#rbtipo:checked").val();
    var fecha1 = $("#txtfecha1").val();
    var fecha2 = $("#txtfecha2").val();
    
    $.post(
            "../controlador/devolucion.listar.controlador.php",
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_tipo: tipo
            }
            ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $('#tabla-listado').dataTable({
                    "aaSorting": [[1, "desc"]],
                    
                    "sScrollX":       "100%",
                    "sScrollXInner":  "100%",
                    "bScrollCollapse": true,
                    "bPaginate":       true 
                });
            });
};

$(document).ready(function(){
    listar(); 
});

$("#btnfiltrar").click(function(){
    listar(); 
});


function detalles(cod_dev){
//    alert(cod_pedido );
//    var cod_ped = "cod_ped".cod_pedido;
    var cod_devolucion =  $("#cod_devolucion"+ cod_dev).html();
        
    
    $.post(
            "../controlador/devolucion.detalle.controlador.php",
            {
                cod_devolucion: cod_devolucion,
                
            }
            ).done(function(resultado){
                $("#detalle").empty();
                $("#detalle").append(resultado);
                
            });
    
}




$("#btnagregar").click(function(){
   document.location.href="devoluciones.php";
});