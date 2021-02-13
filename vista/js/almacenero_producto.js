
function listar(){
    $("#listado").empty();
    $("#listado").load("../controlador/almacenero_producto.controlador.php");
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


function cargarUnidad(){
    $("#cmb-descripcion").load("../controlador/producto.unidad.controlador.php");
}



$(document).ready(function(){
//    cargarMarca();
//    cargarLinea();

    $('#nom-insumo').html('hola');
    
    
    listar();
    cargarUnidad();
    
    
});

//$("#cmb-descripcion").change(function (){
//    /* Para obtener el texto */
//    var combo = document.getElementById("cmb-descripcion");
//    var selected = combo.options[combo.selectedIndex].text;
////    alert(selected);
//    $("#txtdescripcion").val(selected);
//})

$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }
   
   var valor = $("#cmb-descripcion").val();
      
   if (valor === '0'){
        alert("seleccione una Unidad de Medida");
        $("#cmb-descripcion").focus();
        return 0;
   }
      
   $.post(
           "../controlador/producto.agregar.editar.controlador.php",
            {
                p_array_datos: $("#frmgrabar").serialize()
            }
        ).done(function(resultado){
            alert(resultado);
           if(resultado==="exito"){
               listar();
               $("#btncerrar").click();
           }
           
        }).fail(function(error){
            alert(error.responseText);
        });
   
});
//function detalles(index){
//    $("#index").val(index);
//    
//    $.post(
//            "../controlador/producto.detalle.controlador.php",{
//                
//            }
//            ).done(function(resultado)){
//                $
//            }
//}




function agregar(){
    $("#myModalLabel").empty().append("Agregar nuevo Insumo");
    $("#txttipooperacion").val("agregar");
    
    $("#txtcodigo").val("");
    $("#txtnombre").val("");
    $("#txtstockmin").val("");
    $("#txtstock").val("");
    $("#txtdescripcion").val(" ");
    $("#cmb-descripcion").val(0);
//    $("#cbomarca_modal").val("");
//    $("#cbolinea_modal").val("");
//    $("#cbocategoria_modal").empty();
//    $("#cbocategoria_modal").val("");
    
}

function editar(codproducto){
    $("#myModalLabel").empty().append("Editar datos de Insumo");
    $("#txttipooperacion").val("editar");
    
    $.post(
            "../controlador/producto.leer.datos.controlador.php",
            {
                codProd : codproducto
            }
            ).done(function(resultado){
                //alert(resultado);
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.codproducto);
                $("#txtnombre").val(datos.nombre);
                $("#txtstockmin").val(datos.stock_min);
                $("#txtstock").val(datos.stock);
                $("#txtcosto").val(datos.precio);                
                $("#txtventa").val(datos.precio_venta);
                
                
                
                /* Para obtener el texto 
                    var combo = document.getElementById("cmb-descripcion");
                    
                    var selected = combo.options[combo.selectorText].text;
                    
                    combo.options[combo.selectorText].val
                    
                    $("cmb-descripcion").val()*/
                
                $("#cmb-descripcion").val(datos.idunid);
//                $("#cbomarca_modal").val(datos.codigo_marca);
//                $("#cbolinea_modal").val(datos.codigo_linea);
//                $("#cbolinea_modal").change();
                
                
                
                //alert(datos.nombre);
                
            }).fail(function(error){
                alert(error.responseText);
            });
}


function eliminar(codigo){
    if (! confirm("Esta seguro de eliminar el registro seleccionado")){
        return 0;
    }
    $.post(
            "../controlador/producto.eliminar.controlador.php",
            {
                codProd : codigo
            }
        ).done(function(resultado){
            if (resultado==="exito"){
                listar();
            }
        }).fail(function(error){
            alert(error.responseText);
        });
}

$("#myModal").on('shown.bs.modal', function(){
    $("#txtnombre").focus();
});


function estado(codigo){
    $.post(
            "../controlador/producto.estado.controlador.php",
            {
                codProd : codigo
            }
        ).done(function(resultado){
            if (resultado==="exito"){
                alert("Estado Modificado");
                listar();
            }
        }).fail(function(error){
            alert(error.responseText);
        });
}