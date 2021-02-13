function cargarCargo() {
    $("#cmb-cargo").empty();
    $("#cmb-cargo").load("../controlador/usuario.cargo.controlador.php");
}

function cargarArea() {
    $("#cmb-area").empty();
    $("#cmb-area").load("../controlador/usuario.area.controlador.php");
}

function listar() {
    $("#listado").empty();
    $("#listado").load("../controlador/usuario.listar.controlador.php");
    $('#tabla-listado').dataTable({
        "aaSorting": [[1, "asc"]],
        "sScrollX": "150%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
        "bPaginate": true
    });
}



$(document).ready(function () {
    cargarCargo();
    cargarArea();
    listar();
});



function estado(dni) {
    $.post(
            "../controlador/usuario.estado.controlador.php",
            {
                P_dni: dni
            }
    ).done(function (resultado) {
        if (resultado === "exito") {
            alert("Estado Modificado");
            listar();
        }
    }).fail(function (error) {
        alert(error.responseText);
    });
}


function agregar() {
    $("#myModalLabel").empty().append("Agregar nuevo Usuario");
    $("#txttipooperacion").val("agregar");

    document.getElementById("txtdni").removeAttribute('readonly');
    document.getElementById("txtpass").removeAttribute('readonly');
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


$("#frmgrabar").submit(function (event) {
    event.preventDefault(); //ignore el evento

    if (!confirm("Esta seguro de grabar los datos")) {
        return 0;
    }

    var valor = $("#cmb-cargo").val();

    if (valor === '0') {
        alert("seleccione un Cargo");
        $("#cmb-cargo").focus();
        return 0;
    }
    var valor = $("#cmb-area").val();

    if (valor === '0') {
        alert("seleccione un Area");
        $("#cmb-area").focus();
        return 0;
    }


    $.post(
            "../controlador/usuario.agregar.editar.controlador.php",
            {
                p_array_datos: $("#frmgrabar").serialize()
            }
    ).done(function (resultado) {
        alert(resultado);
        if (resultado === "exito") {
            listar();
            $("#btncerrar").click();
        }

    }).fail(function (error) {
        alert(error.responseText);
    });

});



function editar(dni) {
    $("#myModalLabel").empty().append("Editar Usuario");
    $("#txttipooperacion").val("editar");

//    document.getElementById("btnatender").classList.remove('hidden');
    document.getElementById("txtdni").setAttribute('readonly', "");
    document.getElementById("txtpass").setAttribute('readonly', "");

    

    $.post(
            "../controlador/usuario.leer.datos.controlador.php",
            {
                p_dni: dni
            }
    ).done(function (resultado) {
        //alert(resultado);
        var datos = $.parseJSON(resultado);

        $("#txtdni").val(datos.dni);
        $("#txtnombre").val(datos.nombre);
        $("#txtapep").val(datos.ape_p);
        $("#txtapem").val(datos.ape_m);
        $("#txtdir").val(datos.direccion);
        $("#txtemail").val(datos.email);
        $("#txttelefono").val(datos.telefono);
        $("#cmb-cargo").val(datos.cargo);
        $("#cmb-area").val(datos.area);
        $("#txtpass").val("");



    }).fail(function (error) {
        alert(error.responseText);
    });
}