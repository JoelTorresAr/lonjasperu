

function listar() {
    $("#listado").empty();
    $("#listado").load("../controlador/reporte.usuario.listar.controlador.php");
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


