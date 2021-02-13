
$('#btnlimpiar').click(function (){
    $('#txtpass-1').val("");
    $('#txtpass-2').val("");
    $('#txtpass-3').val("");
});

$('#txtpass-2').focus(function (){
    
    if ($('#txtpass-1').val()!=""){
//        alert($("#frmgrabar").serialize());
    $.post(
           "../controlador/contrasena.validar.controlador.php",
            {
                p_array_datos: $("#frmgrabar").serialize()
                
            }
        ).done(function(resultado){
            
            if(resultado==="exito"){
                
            }else{
                alert("contraseña no coincide");
                $('#txtpass-1').focus();
            }
                                   
        }).fail(function(error){
            alert(error.responseText);
        });
        
    }
    
});


$('#txtpass-3').focus(function (){
    var pass1 = $('#txtpass-1').val();
    var pass2 = $('#txtpass-2').val();
    
    if(pass1=='' && pass2==''){
        document.getElementById("frmconfirmar-pass").classList.remove('has-error');
        document.getElementById("frmconfirmar-pass").classList.remove('has-success');
        document.getElementById("msj-ayuda-exito").classList.add('hidden');
        document.getElementById("msj-ayuda-error").classList.add('hidden');
        return 0;
    }
    if(pass1==pass2){
        document.getElementById("frmconfirmar-pass").classList.remove('has-error');
        document.getElementById("frmconfirmar-pass").classList.add('has-success');
        document.getElementById("msj-ayuda-error").classList.add('hidden');
        document.getElementById("msj-ayuda-exito").classList.remove('hidden');
        
    }else{
        document.getElementById("frmconfirmar-pass").classList.remove('has-success');
        document.getElementById("frmconfirmar-pass").classList.add('has-error');
        document.getElementById("msj-ayuda-error").classList.remove('hidden');
        document.getElementById("msj-ayuda-exito").classList.add('hidden');
    }
    
    
    
    
    
        
    
});





$("#frmgrabar").submit(function(event){
    event.preventDefault(); //ignore el evento
    var pass1 = $('#txtpass-1').val();
    var pass2 = $('#txtpass-2').val();
    var pass3 = $('#txtpass-3').val();
    
    if(pass1===pass2){
        
        
  
    
     $.post(
            "../controlador/contrasena.actualizar.controlador.php",
            {
                p_array_datos: $("#frmgrabar").serialize()
            }
    ).done(function (resultado) {
        alert(resultado);
        if (resultado === "exito") {
            location.href= "almacenero_menu.php";
        }

    }).fail(function (error) {
        alert(error.responseText);
    });

   }
   
});



