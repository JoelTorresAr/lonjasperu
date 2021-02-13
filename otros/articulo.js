function listar(){
    var codigo_marca = $("#cbomarca").val();
    $.post("../controlador/articulo.controlador.php", {p_codigo_marca: codigo_marca})
            .done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $("#tbl-listado").dataTable();
            });
}

$("#cbomarca").change(function(){
    listar();
});