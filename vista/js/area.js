
function listarArea(){
    $("#listado").empty();
    $("#listado").load("../controlador/area.controlador.php");
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



function cargarPersonal(){
    $("#cmb-encargado").load("../controlador/area.encargado.controlador.php");
}
$(document).ready(function(){
//    cargarMarca();
//    cargarLinea();
    listarArea();
    cargarPersonal();
});


$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }
   
   $.post(
           "../controlador/area.agregar.editar.controlador.php",
            {
                p_array_datos: $("#frmgrabar").serialize()
            }
        ).done(function(resultado){
            alert(resultado);
           if(resultado==="exito"){
               listarArea();
               $("#btncerrar").click();
           }
           
        }).fail(function(error){
            alert(error.responseText);
        });
   
});

function agregar(){
    $("#myModalLabel").empty().append("Agregar nueva área");
    $("#txttipooperacion").val("agregar");
    
    $("#txtcodigo").val("");
    $("#txtnombre").val("");
    $("#txtdescripcion").val("");
    $("#cmb-encargado").val("");
//    $("#cbomarca_modal").val("");
//    $("#cbolinea_modal").val("");
//    $("#cbocategoria_modal").empty();
//    $("#cbocategoria_modal").val("");
    
}

function editar(codarea){
    $("#myModalLabel").empty().append("Editar datos de Área");
    $("#txttipooperacion").val("editar");
    
    $.post(
            "../controlador/area.leer.datos.controlador.php",
            {
                codArea : codarea
            }
            ).done(function(resultado){
                //alert(resultado);
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.codigo_area);
                $("#txtnombre").val(datos.nombre);
                $("#txtdescripcion").val(datos.descripcion);                
                $("#cmb-encargado").val(datos.encargado_per);
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
            "../controlador/area.eliminar.controlador.php",
            {
                codarea : codigo
            }
        ).done(function(resultado){
            if (resultado==="exito"){
                listarArea();
            }
        }).fail(function(error){
            alert(error.responseText);
        });
}

$("#myModal").on('shown.bs.modal', function(){
    $("#txtnombre").focus();
});