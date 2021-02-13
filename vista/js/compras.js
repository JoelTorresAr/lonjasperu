

$(document).ready(function(){
    //cargarTipoComprobante(); 
    //obtenerIGV();
});



$("#btnagregar").click(function(){
    
    if ( $("#txtcodigoproducto").val().toString() === "" ){
        alert("Debe seleccionar un producto");
        $("#txtprecio").val("");
        $("#txtcantidad").val("");
        $("#txtidunidad").val("");
        $("#txtproducto").focus();
        return 0;
    }

    var codigo   = $("#txtcodigoproducto").val();
    var nombre   = $("#txtproducto").val();
    var precio   = $("#txtprecio").val();
    var igv   = $("#txtigv").html();
    precio = (precio/(1+(igv/100))).toFixed(2);
    var cantidad   = $("#txtcantidad").val();
    var idunidad   = $("#txtidunidad").val();
    var importe = (precio * cantidad).toFixed(2);

    var fila =   "<tr>"+
                     "<td>"+ codigo +"</td>"+
                     "<td>" + nombre + "</td>"+
                     "<td style=\"text-align: right\">" + precio + "</td>"+
                     "<td style=\"text-align: right\" id=\"ccantidad\">" + cantidad + "</td>"+
                     "<td style=\"text-align: right\">" + importe + "</td>"+
                     "<td align=\"center\" id=\"celiminar\"><a href=\"javascript:void();\"><i class=\"fa fa-trash text-orange\"></i></a></td>"+
                     "<td hidden style=\"text-align: right\">" + idunidad + "</td>"+
                  "</tr>";

     $("#detallecompra").append(fila);
     

     $("#txtcodigoproducto").val("");
     $("#txtproducto").val("");
     $("#txtprecio").val("");
     $("#txtcantidad").val("");
     $("#txtidunidad").val("");
     $("#txtproducto").focus();
     
     calcularTotales();
   
});


$("#txtcantidad").keypress(function(evento){
    if (evento.which === 13){
        evento.preventDefault(); //ignore el evento
        $("#btnagregar").click();
    }
});

$(document).on("click", "#celiminar", function(){
    if (! confirm("Esta seguro de elimina el registro seleccionado")){
        return 0;
    }
    var fila = $(this).parents().get(0); //capturar la fila que deseamos eliminar 
    fila.remove(); //eliminar la fila
    calcularTotales();
});

$(document).on("dblclick", "#ccantidad", function(){
   var cantidad = $(this).html();
   
   if (cantidad.substring(0,6)==="<input"){
       return 0;
   }
   
   $(this).empty().append('<input type="text" id="txtactualizar" class="form-control" value = "' + cantidad + '"/>');
   $("#txtactualizar").focus();
   
});

$(document).on("keypress", "#txtactualizar", function(evento){
    
    if (evento.which === 13){
        var cantidad = $(this).val();
        $(this).parents().find("td").eq(3).empty().append(cantidad);
        
//        var precio = $(this).parent().find("td").eq(2).html();
//        var cantidad = $(this).parents().find("td").eq(3).html();
//        var importe = precio * cantidad;
        
//        $(this).parents().find("td").eq(4).empty().append(importe);
                
    }else{
        return validarNumeros(evento);
    }
});



function calcularTotales(){
//    var importeSubTotal=0;
//    var importeIGV=0;
    var importeNeto=0;

    $("#detallecompra tr").each(function(){
        var importe = $(this).find("td").eq(4).html();
        importeNeto = importeNeto + parseFloat(importe);
    });
    
    importeIGV = importeNeto * (18/100);
    importeSubTotal = importeNeto + importeIGV;
    
    $("#txtimporteneto").val(importeNeto.toFixed(2)); //TOFIXED = numero de decimales (2) EJM: S/.12.50
    $("#txtimportetotal").val(importeSubTotal.toFixed(2));
    $("#txtimporteigv").val(importeIGV.toFixed(2));
    
}

//function obtenerIGV(){
//    $.post(
//            "../controlador/configuracion.controlador.php",
//            {
//                p_codigo: 1
//            }
//          ).done(function(resultado){
//              $("#txtigv").val(resultado);
//          });
//}


var arrayDetalle = new Array();

$("#frmgrabar").submit(function(evento){
   evento.preventDefault();
   
    /*limpiar el array*/
    arrayDetalle.splice(0, arrayDetalle.length);
    /*limpiar el array*/
    
    
    var tab = $("#detallecompra tr").length;
    
    if (tab === 0){
        alert("Agrege Insumos");
        return 0;
    }
    
    
   
   /*CAPTURAR LOS DATOS PARA EL DETALLE DE COMPRA*/
   var item=0;
   $("#detallecompra tr").each(function(){
       var codigoArticulo = $(this).find("td").eq(0).html();
       item = item + 1;
       var cantidad = $(this).find("td").eq(3).html();
       var precio = $(this).find("td").eq(2).html();
       var importe = $(this).find("td").eq(4).html();
       var idunidad = $(this).find("td").eq(6).html();
       
       
       var objDetalle = new Object();
       objDetalle.codigoArticulo = codigoArticulo;
       objDetalle.item      = item;
       objDetalle.cantidad  = cantidad;
       objDetalle.precio    = precio;
       objDetalle.importe   = importe;
       objDetalle.idunidad   = idunidad;
       
       arrayDetalle.push(objDetalle);
       
   });
   
   var jsonDetalle = JSON.stringify(arrayDetalle);
   
   //alert(jsonDetalle);
   /*CAPTURAR LOS DATOS PARA EL DETALLE DE COMPRA*/
   
    
   
   $.post(
           "../controlador/compra.controlador.php",
           {
               p_array_datos_cabecera: $("#frmgrabar").serialize(),
               p_json_datos_detalle: jsonDetalle
           }
        ).done(function(resultado){
            if ($.trim(resultado)==="exito"){
                document.location.href="almacenero_compras-listado.php";
            }
           //alert(resultado);
           
        }).fail(function(error){
            alert("Error:" + error.responseText);
        });
        
   
});