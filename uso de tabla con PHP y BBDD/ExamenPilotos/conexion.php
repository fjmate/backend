<?php

   //Establecemos los parámetros de conexión
    $host = "localhost";
    $usuario = "dwes";
    $password = "dwes";
    $bd = "pilotos";
    
    $conexion = mysqli_connect($host, $usuario, $password, $bd);
    
    if(!$conexion){
        echo "No se ha podido conectar";
    }
?>