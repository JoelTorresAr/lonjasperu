function cargarTipoComprobante(){
    $("#cbotipdoc").load("../controlador/leer.tipo-comprobante.controlador.php");
}

function inicializar(){
//    $("#txtdniusuario").val("");
    $('#txtproducto').focus();
    $("#txtcodigoproducto").val("");
    $("#txtcantidad").val("");
    
}

$(document).ready(function(){
    
    inicializar()
});



$('#txtcantidad').focus(function (){
    var max = $("#txtstock").val();
//    
//   
//    var txtcantidad = document.getElementById('#txtcantidad');
    
//    txtcantidad.maxLength = 2;
    
//    txtcantidad.setAttribute("max", max);


    $("#txtcantidad").attr("max", max);
    
});

$("#btnagregar").click(function(){
    
    if ( $("#txtcodigoproducto").val().toString() === "" ){
        alert("Debe seleccionar un producto");
        $("#txtproducto").val("");
        $("#txtcantidad").val("");
        $("#txtproducto").focus();
        return 0;
    }
    
    if ( $("#txtcantidad").val().toString() === ""  ){
        alert("Debe ingresar una cantidad");
        $("#txtcantidad").val("");
        $("#txtcantidad").focus();
        return 0;
    }

    var codigo   = $("#txtcodigoproducto").val();
    var nombre   = $("#txtproducto").val();
    var cantidad = $("#txtcantidad").val();
    
    var fila =   "<tr>"+
                     "<td>"+ codigo +"</td>"+
                     "<td>" + nombre + "</td>"+
                     "<td style=\"text-align: right\" id=\"ccantidad\">" + cantidad + "</td>"+
                     "<td align=\"center\" id=\"celiminar\"><a href=\"javascript:void();\"><i class=\"fa fa-trash text-orange\"></i></a></td>"+
                  "</tr>";
          
     
     $("#detallepedido").append(fila);
     

     $("#txtcodigoproducto").val("");
     $("#txtproducto").val("");
     $("#txtcantidad").val("");
     $("#txtstock").val("");
     
     $("#txtproducto").focus();
     
});


$("#txtcantidad").keypress(function(evento){
    if (evento.which === 13){
        $("#txtcantidad").keyup();
        
        
        evento.preventDefault(); //ignore el evento
        $("#btnagregar").click();
    }
    
});

$("#txtcantidad").keyup(function(evento){
    
    
    var cant = $("#txtcantidad").val();
    var stock = $("#txtstock").val();
    
    
    var ca = parseInt(cant);
    var st = parseInt(stock);
    
    if(ca > st){ 
        alert("Stock Insuficiente");
        $("#txtcantidad").val(stock);
    }
    
});





$(document).on("click", "#celiminar", function(){
    if (! confirm("Esta seguro de elimina el registro seleccionado")){
        return 0;
    }
    var fila = $(this).parents().get(0); //capturar la fila que deseamos eliminar 
    fila.remove(); //eliminar la fila
    /*calcularTotales();*/
});

//$(document).on("dblclick", "#ccantidad", function(){
//   var cantidad = $(this).html();
//   
//   if (cantidad.substring(0,6)==="<input"){
//       return 0;
//   }
//   
//   $(this).empty().append('<input type="text" id="txtactualizar" class="form-control" value = "' + cantidad + '"/>');
//   $("#txtactualizar").focus();
//   
//});
//
//$(document).on("keypress", "#txtactualizar", function(evento){
//    
//    if (evento.which === 13){
//        var cantidad = $(this).val();
//        $(this).parents().find("td").eq(2).empty().append(cantidad);
//    }else{
//        return validarNumeros(evento);
//    }
//});


function calcularTotales(){
    var importeSubTotal=0;
    var importeIGV=0;
    var importeNeto=0;

    $("#detallecompra tr").each(function(){
        var importe = $(this).find("td").eq(4).html();
        importeNeto = importeNeto + parseFloat(importe);
    });
    
    importeSubTotal = importeNeto / (1 + (18/100));
    importeIGV = importeNeto - importeSubTotal;
    
    $("#txtimporteneto").val(importeNeto.toFixed(2));
    $("#txtimportesubtotal").val(importeSubTotal.toFixed(2));
    $("#txtimporteigv").val(importeIGV.toFixed(2));
    
}

function obtenerIGV(){
    $.post(
            "../controlador/configuracion.controlador.php",
            {
                p_codigo: 1
            }
          ).done(function(resultado){
              $("#txtigv").val(resultado);
          });
}


var arrayDetalle = new Array();

$("#frmgrabar").submit(function(evento){
//    alert($("#txtdniusuario").val().toString()+" "+$("#txtusuario").val().toString());
    if ( $("#txtdniusuario").val().toString() === "" ){
    
        alert("Debe seleccionar un usuario");
        $("#txtdniusuario").val("");
        $("#txtusuario").val("");
        $("#txtusuario").focus();
        
//        if ( $("#txtdniusuario").val().toString() === "" ){
        
        return 0;
    }
    
   evento.preventDefault();
   
    /*limpiar el array*/
    arrayDetalle.splice(0, arrayDetalle.length);
    /*limpiar el array*/
    
    var tab = $("#detallepedido tr").length;
    
    
    if (tab === 0){
        alert("Agrege Insumos");
        return 0;
    }
    
   
   /*CAPTURAR LOS DATOS PARA EL DETALLE DE COMPRA*/
   /*var item=0;*/
   $("#detallepedido tr").each(function(){
       var codigoProducto = $(this).find("td").eq(0).html();
       /*item = item + 1;*/
       var cantidad = $(this).find("td").eq(2).html();
       
       var objDetalle = new Object();
       objDetalle.codProducto = codigoProducto;
       /*objDetalle.item      = item;*/
       objDetalle.cantidad  = cantidad;
       
       
       arrayDetalle.push(objDetalle);
       
   });
   
   var jsonDetalle = JSON.stringify(arrayDetalle);
   
   //alert(jsonDetalle);
   /*CAPTURAR LOS DATOS PARA EL DETALLE DE COMPRA*/
   
//    alert( $("#frmgrabar").serialize());
//    alert(jsonDetalle);
   $.post(
           "../controlador/pedido.controlador.php",
           {
               p_array_datos_cabecera: $("#frmgrabar").serialize(),
               p_json_datos_detalle: jsonDetalle
           }
        ).done(function(resultado){
            if ($.trim(resultado)==="exito"){
                document.location.href="../vista/principalpedido.php";
            }
           //alert(resultado);
           
        }).fail(function(error){
            alert("Error:" + error.responseText);
        });
        
   
});