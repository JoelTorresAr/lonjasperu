function cargarMarca(){
    $("#cbomarca").load("../controlador/articulo.marca.controlador.php?modal=0");
    $("#cbomarca_modal").load("../controlador/articulo.marca.controlador.php?modal=1");
}

function cargarLinea(){
    $("#cbolinea").load("../controlador/articulo.linea.controlador.php?modal=0");
    $("#cbolinea_modal").load("../controlador/articulo.linea.controlador.php?modal=1");
}

function cargarCategoria(nombreCombo){
    $(nombreCombo).empty();
    
    var codigo_linea = "";
    var modal = "";
    
    if (nombreCombo == "#cbocategoria"){
        codigo_linea = $("#cbolinea").val();
        modal = "0";
    }else{
        codigo_linea = $("#cbolinea_modal").val();
        modal = "1";
    }
    
    
    $.post(
            "../controlador/articulo.categoria.controlador.php",
            {
                p_codigo_linea: codigo_linea, 
                p_modal : modal
            }
          )
          .done(function(resultado){
              $(nombreCombo).empty();
              $(nombreCombo).append(resultado);
          })
          
          .fail(function(error){
              alert(error.responseText);
          });
}

function listar(){
    var codigo_marca = $("#cbomarca").val();
    if (codigo_marca == null){
        codigo_marca = 0;
    }
    
    var codigo_linea = $("#cbolinea").val();
    if (codigo_linea == null){
        codigo_linea = 0;
    }
    
    var codigo_categoria = $("#cbocategoria").val();
    if (codigo_categoria == null){
        codigo_categoria = 0;
    }
    
    console.log("codigo_marca: " + codigo_marca);
    console.log("codigo_linea: " + codigo_linea);
    console.log("codigo_categoria: " + codigo_categoria);
    
    $.post(
            "../controlador/articulo.controlador.php", 
            {
                p_codigo_marca      : codigo_marca,
                p_codigo_linea      : codigo_linea,
                p_codigo_categoria  : codigo_categoria
            } 
        )
            .done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $('#tabla-listado').dataTable({
                    "aaSorting": [[1, "asc"]]
                });
    
            });
}


$("#cbomarca").change(function(){
    listar();
});

$("#cbolinea").change(function(){
    cargarCategoria("#cbocategoria");
    listar();
});

$("#cbolinea_modal").change(function(){
    cargarCategoria("#cbocategoria_modal");
});


$("#cbocategoria").change(function(){
    listar();
});

$(document).ready(function(){
    cargarMarca();
    cargarLinea();
    listar();
});


$("#frmgrabar").submit(function(event){
   event.preventDefault(); //ignore el evento
   
   if (! confirm("Esta seguro de grabar los datos")){
       return 0;
   }
   
   $.post(
           "../controlador/articulo.agregar.editar.controlador.php",
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
        })
   
});

function agregar(){
    $("#myModalLabel").empty().append("Agregar nuevo artículo");
    $("#txttipooperacion").val("agregar");
    
    $("#txtcodigo").val("");
    $("#txtnombre").val("");
    $("#txtprecioventa").val("");
    $("#cbomarca_modal").val("");
    $("#cbolinea_modal").val("");
    $("#cbocategoria_modal").empty();
    $("#cbocategoria_modal").val("");
    
}

function editar(codigo){
    $("#myModalLabel").empty().append("Editar datos del artículo");
    $("#txttipooperacion").val("editar");
    
    $.post(
            "../controlador/articulo.leer.datos.controlador.php",
            {
                p_codigo : codigo
            }
            ).done(function(resultado){
                //alert(resultado);
                var datos = $.parseJSON(resultado);
                $("#txtcodigo").val(datos.codigo_articulo);
                $("#txtnombre").val(datos.nombre);
                $("#txtprecioventa").val(datos.precio_venta);
                $("#cbomarca_modal").val(datos.codigo_marca);
                $("#cbolinea_modal").val(datos.codigo_linea);
                $("#cbolinea_modal").change();
                $("#myModal").on('shown.bs.modal', function(){
                    $("#cbocategoria_modal").val(datos.codigo_categoria);
                });
                
                
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
            "../controlador/articulo.eliminar.controlador.php",
            {
                p_codigo_articulo : codigo
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