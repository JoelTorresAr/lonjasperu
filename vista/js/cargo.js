
function listar(){
    $("#listado").empty();
    $("#listado").load("../controlador/cargo.controlador.php");
    $('#tabla-listado').dataTable({
                    "aaSorting": [[1, "asc"]]
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
}




$(document).ready(function(){
//    cargarMarca();
//    cargarLinea();
    listar();
});


$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }
   
   $.post(
           "../controlador/cargo.agregar.editar.controlador.php",
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

function agregar(){
    $("#myModalLabel").empty().append("Detalle de Pedido");
    $("#txttipooperacion").val("agregar");
    
    $("#txtcodigo").val("");
    $("#txtdescripcion").val("");
//    $("#cbomarca_modal").val("");
//    $("#cbolinea_modal").val("");
//    $("#cbocategoria_modal").empty();
//    $("#cbocategoria_modal").val("");
    
}

function editar(codcargo){
    $("#myModalLabel").empty().append("Editar datos de Cargo");
    $("#txttipooperacion").val("editar");
    
    $.post(
            "../controlador/cargo.leer.datos.controlador.php",
            {
                codCargo : codcargo
            }
            ).done(function(resultado){
                //alert(resultado);
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.codigo_cargo);
                $("#txtdescripcion").val(datos.descripcion);
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
            "../controlador/cargo.eliminar.controlador.php",
            {
                codcargo : codigo
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