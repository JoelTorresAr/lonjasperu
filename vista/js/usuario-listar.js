function cargarCargo(){
    $("#cmb-cargo").empty();
    $("#cmb-cargo").load("../controlador/usuario.cargo.controlador.php");
}

function cargarArea(){
    $("#cmb-area").empty();
    $("#cmb-area").load("../controlador/usuario.area.controlador.php");
}

function listar(){
    $("#listado").empty();
    $("#listado").load("../controlador/usuario.listar.controlador.php");
    $('#tabla-listado').dataTable({
                    "aaSorting": [[1, "asc"]],
                    
                    "sScrollX":       "150%",
                    "sScrollXInner":  "100%",
                    "bScrollCollapse": true,
                    "bPaginate":       true
                });
}

$(document).ready(function (){
    cargarCargo();
    cargarArea();
    listar();
});



function estado(dni){
    $.post(
            "../controlador/usuario.estado.controlador.php",
            {
                P_dni : dni
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


function agregar(){
    $("#myModalLabel").empty().append("Agregar nuevo Usuario");
    $("#txttipooperacion").val("agregar");
    
    $("#txtdni").val("");
    $("#txtnombre").val("");
    $("#txtapep").val("");
    $("#txtapem").val("");
    $("#txtdir").val("");
    $("#txtemail").val(" ");
    $("#txttelefono").val(" ");
    $("#cmb-cargo").val(0);
    $("#cmb-area").val(0);
    $("#txtpass").val("");
}


$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }
   
   var valor = $("#cmb-cargo").val();
      
   if (valor === '0'){
        alert("seleccione un Cargo");
        $("#cmb-cargo").focus();
        return 0;
   }
   var valor = $("#cmb-area").val();
      
   if (valor === '0'){
        alert("seleccione un Area");
        $("#cmb-area").focus();
        return 0;
   }
   
    alert($("#frmgrabar").serialize());
      
   $.post(
           "../controlador/usuario.agregar.editar.controlador.php",
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