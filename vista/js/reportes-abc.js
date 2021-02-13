function listar(){
    var fecha1 =  $("#txtfecha1").val();
    var fecha2 =  $("#txtfecha2").val();
    
    $.post(
            "../controlador/reporte.abc.listar.controlador.php",
            {
                p_fecha1: fecha1,
                p_fecha2: fecha2
            }
            ).done(function(resultado){
                $("#listado").empty();
                $("#listado").append(resultado);
                $('#tabla-listado').dataTable({
                    "aaSorting": [[2, "desc"]],
                    
                    "sScrollX":       "100%",
                    "sScrollXInner":  "100%",
                    "bScrollCollapse": true,
                    "bPaginate":       true 
                });


                // console.log($("#hddA").val());
                if ($("#hddA").val()!="0" || $("#hddB").val()!="0" || $("#hddC").val()!="0") {
                    google.charts.load('current', {'packages':['corechart']});
                    google.charts.setOnLoadCallback(drawChart);

                }else{
                    $("#piechart").empty();

                };
            });


    
};

$(document).ready(function(){
    listar(); 
});

$("#btnConsultar").click(function(){
    listar(); 
});

function drawChart() {
    var a =parseInt($("#hddA").val());
    var b =parseInt($("#hddB").val());
    var c =parseInt($("#hddC").val());

    // console.log(a);
            var data = google.visualization.arrayToDataTable([
              ['Categoría', 'Insumos por Categoría'],
              ['A',  a],
              ['B',  b],
              ['C',  c],
            ]);

            var options = {
              title: 'Análisis ABC'
            };

            var chart = new google.visualization.PieChart(document.getElementById('piechart'));

            chart.draw(data, options);
}

function detalles(cod_comp){
//    alert(cod_pedido );
//    var cod_ped = "cod_ped".cod_pedido;
    var cod_compra =  $("#cod_compra"+ cod_comp).html();
        
    
    $.post(
            "../controlador/compra.detalle.controlador.php",
            {
                cod_compra: cod_compra,
                
            }
            ).done(function(resultado){
                $("#detalle").empty();
                $("#detalle").append(resultado);
                
            });
    
}


function anular(nroCompraAnular){
    if (! confirm("Esta seguro de anular la compra seleccionada")){
        return 0;
    }
    
    $.post
            (
                    "../controlador/compra.anular.controlador.php",
                    {
                        p_nro_compra: nroCompraAnular
                    }
            ).done(function (resultado){
                if ($.trim(resultado) === "exito"){
                    listar();
                }
            }).fail(function(error){
                alert(error.responseText);
            })
    
}

$("#btnagregar").click(function(){
   document.location.href="compras.php";
});