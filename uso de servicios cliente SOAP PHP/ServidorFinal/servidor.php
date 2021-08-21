<?php

require '../AccesoAProductos/DBAccess.php';
require '../AccesoAProductos/ListaProductos.php';

function obtenPrecio($nombre) {
    $mysqli = mysqli_connect("localhost", "dwes", "dwes", "Productos");
    if (mysqli_connect_errno($mysqli)) {
        echo "Fallo al conectar a MySQL: " . mysqli_connect_error();
    }

    $resultado = mysqli_query($mysqli, "SELECT precio FROM `productos` WHERE producto='{$nombre}'");
    $fila = mysqli_fetch_assoc($resultado);
    if ($fila == null) {
        $preciocero = 0;
        return $preciocero;
    } else {
        return $fila['precio'];
    }
}

$uri = "http://localhost/ServidorFinal";

$server = new SoapServer(null, array('uri' => $uri));

$server->addFunction("obtenPrecio");

$server->handle();
?>