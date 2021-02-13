function listar(){
    var tipo = "3";
    var fecha1 = "1";
    var fecha2 = "2";
    
    $.post(
            "../controlador/reporte.compra.listar.controlador.php",
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_tipo: tipo
            }
            ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $('#tabla-listado').dataTable({
                    "aaSorting": [[2, "desc"]],
                    
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


function detalles(cod_comp){
//    alert(cod_pedido );
//    var cod_ped = "cod_ped".cod_pedido;
    var cod_compra =  $("#cod_compra"+ cod_comp).html();
        
    
    $.post(
            "../controlador/compra.detalle.controlador.php",
            {
                cod_compra: cod_compra,
                
            }
            ).done(function(resultado){
                $("#detalle").empty();
                $("#detalle").append(resultado);
                
            });
    
}


function anular(nroCompraAnular){
    if (! confirm("Esta seguro de anular la compra seleccionada")){
        return 0;
    }
    
    $.post
            (
                    "../controlador/compra.anular.controlador.php",
                    {
                        p_nro_compra: nroCompraAnular
                    }
            ).done(function (resultado){
                if ($.trim(resultado) === "exito"){
                    listar();
                }
            }).fail(function(error){
                alert(error.responseText);
            })
    
}

$("#btnagregar").click(function(){
   document.location.href="compras.php";
});