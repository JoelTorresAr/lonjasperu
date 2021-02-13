

function listarmovimientos(codproducto) {
    $("#divInsumos").empty();

    var arrayDetalle = new Array();
    var objDetalle = new Object();
       objDetalle.codproducto = codproducto;


    arrayDetalle.push(objDetalle);
    var jsonDetalle = JSON.stringify(arrayDetalle);
   
   //alert(jsonDetalle);
   /*CAPTURAR LOS DATOS PARA EL DETALLE DE COMPRA*/
   
    
   
   $.post(
           "../controlador/reporte.insumo.movimientos.listar.controlador.php",
           {
               p_json_datos_detalle: jsonDetalle
           }
        ).done(function(resultado){
            //if ($.trim(resultado)==="exito"){

                $("#divInsumos").empty();
                $("#divInsumos").append(resultado);
                $('#tabla-divInsumos').dataTable({
                    "aaSorting": [[1, "asc"]],
                    // "sScrollX": "150%",
                    // "sScrollXInner": "100%",
                    // "bScrollCollapse": true,
                    "bPaginate": true
                });
            //}
           //alert(resultado);
           
        }).fail(function(error){
            alert("Error:" + error.responseText);
        });
        

    
    
}

function listar() {
    $("#listado").empty();
    $("#listado").load("../controlador/reporte.insumo.listar.controlador.php");
    $('#tabla-listado').dataTable({
        "aaSorting": [[1, "asc"]],
        "sScrollX": "150%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
        "bPaginate": true
    });
}


$(document).ready(function () {

    listar();
});

function movimientos(codproducto){


    listarmovimientos(codproducto);
}

