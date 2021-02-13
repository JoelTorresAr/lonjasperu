/*INICIO: BUSQUEDA DE USUARIO*/
$("#txtusuario").autocomplete({
    source: "../controlador/usuario.autocompletar.controlador.php",
    minLength: 2, //Filtrar desde que colocamos 2 o mas caracteres
    focus: f_marcar_registro,
    select: f_seleccionar_registro
});

function f_marcar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtusuario").val(registro.nom);
    event.preventDefault();
}

function f_seleccionar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtusuario").val(registro.nom);
    $("#txtdniusuario").val(registro.cod);//campo oculto (hidden)
    
    
    event.preventDefault();
}
/*FIN: BUSQUEDA DE USUARIO*/


/*INICIO: BUSQUEDA DE PRODUCTOS*/
$("#txtproducto").autocomplete({
    source: "../controlador/producto.autocompletar.controlador.php",
    minLength: 2, //Filtrar desde que colocamos 2 o mas caracteres
    focus: f_marcar_registro_producto,
    select: f_seleccionar_registro_producto
});

function f_marcar_registro_producto(event, ui){
    var registro = ui.item.value;
    $("#txtproducto").val(registro.nomprod);
    event.preventDefault();
}

function f_seleccionar_registro_producto(event, ui){
    var registro = ui.item.value;
    $("#txtproducto").val(registro.nomprod);
    $("#txtcodigoproducto").val(registro.codprod); //campo oculto (hidden)
    $("#txtstock").val(registro.stock);
    $("#txtcantidad").val("");
    
    $("#txtcantidad").focus();
    
    event.preventDefault();
}
/*FIN: BUSQUEDA DE PRODUCTOS*/


