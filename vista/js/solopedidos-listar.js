function listar(){
    var tipo = $("#rbtipo:checked").val();
    var fecha1 = $("#txtfecha1").val();
    var fecha2 = $("#txtfecha2").val();
    
    $.post(
            "../controlador/pedido.listar.controlador.php",
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2,
                p_tipo: tipo
            }
            ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $('#tabla-listado').dataTable({
                    "aaSorting": [[6, "desc"]],
                    
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




function nombre(nombre){
    alert(nombre);
}


function detalles(index){
//    alert(cod_pedido );
//    var cod_ped = "cod_ped".cod_pedido;
    var cod_ped =  $("#cod_ped"+ index).html();
    var nombre = $("#nombre"+ index).html();
    var estado = $("#estado"+ index).html();
    
    $("#index").val(index);
    
    
    $.post(
            "../controlador/pedido.detalle.controlador.php",
            {
                cod_pedido: cod_ped,
                nom_usuario: nombre,
                estado: estado
            }
            ).done(function(resultado){
                $("#detalle").empty();
                $("#detalle").append(resultado);
                $("#cod_pedido").empty();
                $("#cod_pedido").val(cod_ped);
                
                if (estado === 'Atendido'){
                    document.getElementById("btnatender").classList.add('hidden');
                }else{
                    document.getElementById("btnatender").classList.remove('hidden');
                }
                
                
                
            });
    
}


var arrayDetalle = new Array();

function atender(){
    
    
    /*limpiar el array*/
    arrayDetalle.splice(0, arrayDetalle.length);
    /*limpiar el array*/
   
    $("#datos-detalle-detalle tr").each(function(){
        
       var cod_ped = $("#cod_pedido").val().toString();
       
       var cod_prod = $(this).find("td").eq(0).html();
       
       var stock = $(this).find("td").eq(3).html();
       
       var pen = $(this).find("td").eq(4).html();
       /*item = item + 1;*/
       var cant = $(this).find("td").eq(5).html();
       
       
       
       var objDetalle = new Object();
       objDetalle.codPedido = cod_ped;
       objDetalle.codProducto = cod_prod;
       /*objDetalle.item      = item;*/
       objDetalle.pendiente  = pen;
       objDetalle.cantidad  = cant;
       objDetalle.stock  = stock;
       
       
       
       arrayDetalle.push(objDetalle);
       
   });
   
   var jsonDetalle = JSON.stringify(arrayDetalle);
   
   
    
    
//    var cod_ped = $("#cod_pedido").val().toString();
//    
    $.post(
            "../controlador/pedido.atender.detalle.controlador.php",
            {
                P_detalle: jsonDetalle,
            }).done(function(resultado){
//                if ($.trim(resultado) === "exito"){

                    var tpen = $.trim(resultado);
//                    tpen = parseInt(tpen);
                    
                    atender_pedido(tpen);
                    
                //}
//                listar();
            });
//            
}


function atender_pedido(tpen){
//    var index = $("#index").val();
    
                    var cod_ped = $("#cod_pedido").val().toString();
                    $.post(
                            "../controlador/pedido.atender.controlador.php",
                            {
                                P_Tpen: tpen,
                                P_cod_ped: cod_ped
                            }).done(function(resultado){
                                if($.trim(resultado)==="pendiente"){
                                    alert("Insumos Pendientes"); 
                                }
                                listar();
                                $("#btncerrar").click();
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
   document.location.href="solopedido.php";
});