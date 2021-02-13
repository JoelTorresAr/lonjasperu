/*INICIO: BUSQUEDA DE PROVEEDORES*/
$("#txtproveedor").autocomplete({
    source: "../controlador/proveedor.autocompletar.controlador.php",
    minLength: 2, //Filtrar desde que colocamos 2 o mas caracteres
    focus: f_marcar_registro,
    select: f_seleccionar_registro
});

function f_marcar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtproveedor").val(registro.rs);
    event.preventDefault();
}

function f_seleccionar_registro(event, ui){
    var registro = ui.item.value;
    $("#txtproveedor").val(registro.rs);
    $("#txtcodprov").val(registro.cod);
    $("#lbldireccionproveedor").val(registro.dir);
    
    
    event.preventDefault();
}
/*FIN: BUSQUEDA DE PROVEEDORES*/


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
    $("#txtunidad").val(registro.unidad);
    $("#txtcodigoproducto").val(registro.codprod); //campo oculto (hidden)
    $("#txtidunidad").val(registro.idunidad); //campo oculto (hidden)
    $("#txtprecio").focus();

    
    /*$("#txtcantidad").focus();*/
    
    event.preventDefault();
}
/*FIN: BUSQUEDA DE PRODUCTOS*/



/*INICIO: BUSQUEDA DE ARTICULOS*/

/*FIN: BUSQUEDA DE ARTICULOS*/


