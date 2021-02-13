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

/*$('#txtcantAtender').focus(function (){
    var max = $("#txtstock").val();
    $("#txtcantAtender").attr("max", max);
    
});*/

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
    var cod_user = $("#usuario"+ index).html();
    var cod_area = $("#area"+ index).html();
    
    $("#index").val(index);
    
    
    $.post(
            "../controlador/pedido.detalle.controlador.php",
            {
                cod_pedido: cod_ped,
                nom_usuario: nombre,
                estado: estado,
                cod_user: cod_user,
                cod_area: cod_area
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
       var cod_ped = $("#cod_pedido").val().toString();
       var cod_usuario = $("#codusuario").val();
       var cod_area = $("#codarea").val();

       var objDetalle = new Object();
       objDetalle.codPedido = cod_ped;
       objDetalle.codUsuario  = cod_usuario;
       objDetalle.codArea  = cod_area;
       
       
       arrayDetalle.push(objDetalle);

    $("#datos-detalle-detalle tr").each(function(){
        
       var cod_ped = $("#cod_pedido").val().toString();
       
       var cod_prod = $(this).find("td").eq(0).html();
       
       var stock = $(this).find("td").eq(4).html();
       
       var pen = $(this).find("td").eq(5).html();
       /*item = item + 1;*/
       var cant = $(this).find("td").eq(7).find("input").val();

       var uni = $(this).find("td").eq(8).html();
       var precio = $(this).find("td").eq(9).html();
           
       

       var objDetalle = new Object();
       objDetalle.codPedido = cod_ped;
       objDetalle.codProducto = cod_prod;
       /*objDetalle.item      = item;*/
       objDetalle.pendiente  = pen;
       objDetalle.cantidad  = cant;
       objDetalle.stock  = stock;
       objDetalle.uni  = uni;       
       objDetalle.precio  = precio;
       
       arrayDetalle.push(objDetalle);
   });
   

   if(ValidarAtender(arrayDetalle) ==true){
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
   }
  
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
   document.location.href="almacenero_pedido.php";
});

function ValidarAtender(arrayDetalle){

  for (var i = 1; i <= arrayDetalle.length-1; i++) {

    if(parseInt(arrayDetalle[i].cantidad) >parseInt(arrayDetalle[i].stock)){
      alert('Stock insuficiente');
      return false;

    }
   
    if(parseInt(arrayDetalle[i].cantidad )>parseInt(arrayDetalle[i].pendiente)){
      alert('La cantidad a atender debe ser menor o igual a la cantidad pendiente.');
      return false;

    }
    // if(parseInt(arrayDetalle[i].cantidad) <=0){
    //   alert('La cantidad a atender debe ser mayor a 0');
    //   return false;

    // }
  };

return true;
}