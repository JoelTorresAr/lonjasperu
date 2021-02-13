function listar(lis){
    
    
    $.post("../controlador/reporte.pedido.listar.controlador.php",
    {
        p_listar: lis
    }).done(function(resultado){
        $("#listado").empty();
        $("#listado").append(resultado);
        
        $('#tabla-listado').dataTable({
        "aaSorting": [[1, "asc"]],
        "sScrollX": "150%",
        "sScrollXInner": "100%",
        "bScrollCollapse": true,
        "bPaginate": true
    });
    });
    
};

$(document).ready(function(){
    var lis = '1';
    listar(lis); 
});

function detalles(index){
//    alert(cod_pedido );
//    var cod_ped = "cod_ped".cod_pedido;
    var cod_ped =  $("#cod_ped"+ index).html();
    var nombre = $("#nombre"+ index).html();
    var estado = $("#estado"+ index).html();
    
    //$("#index").val(index);
    
    
    $.post(
            "../controlador/pedido.detalle.controlador.php",
            {
                cod_pedido: cod_ped,
                nom_usuario: nombre,
                estado: estado
            }
            ).done(function(resultado){
                $("#detalle").empty();
                $("#detalle").append(resultado);
//                $("#cod_pedido").empty();
//                $("#cod_pedido").val(cod_ped);
                
                                
            });
    
}