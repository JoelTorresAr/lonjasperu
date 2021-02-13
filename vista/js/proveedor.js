/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function listar(){
    $("#listado").empty();
    $("#listado").load("../controlador/proveedor.controlador.php");
    $('#tabla-listado').dataTable({
                    "aaSorting": [[1, "asc"]]
                });
}

$(document).ready(function (){
    listar();
});



$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }
   
   $.post(
           "../controlador/proveedor.agregar.editar.controlador.php",
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
    $("#myModalLabel").empty().append("Agregar nuevo Proveedor");
    $("#txttipooperacion").val("agregar");
    
    $("#txtcodigo").val("");
    $("#txtrazsocial").val("");
    $("#txtruc").val("");
    $("#txtdireccion").val("");
    
}


function editar(codproveedor){
    $("#myModalLabel").empty().append("Editar datos de Proveedor");
    $("#txttipooperacion").val("editar");
    
    $.post(
            "../controlador/proveedor.leer.datos.controlador.php",
            {
                codProv : codproveedor
            }
            ).done(function(resultado){
                //alert(resultado);
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.codproveedor);
                $("#txtrazsocial").val(datos.razonsocial);
                $("#txtruc").val(datos.ruc);
                $("#txtdireccion").val(datos.direccion);
                
                
            }).fail(function(error){
                alert(error.responseText);
            });
}

function eliminar(codigo){
    if (! confirm("Esta seguro de eliminar el registro seleccionado")){
        return 0;
    }
    $.post(
            "../controlador/proveedor.eliminar.controlador.php",
            {
                codProv : codigo
            }
        ).done(function(resultado){
            if (resultado==="exito"){
                listar();
            }
        }).fail(function(error){
            alert(error.responseText);
        });
}