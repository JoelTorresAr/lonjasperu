<?php

    session_name("sistema-comercial");
    session_start();
    
    unset($_SESSION["usuario"]);
    unset($_SESSION["cargo"]);
    
    session_destroy();
    
    header("location:../vista/index.php");
    
    

